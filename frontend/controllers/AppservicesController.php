<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use common\models\News;
use common\models\Catnew;

/**
 * API Public Controller
 */
class AppservicesController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'get-all-news' => ['get'],
                    'get-news-by-id' => ['post'],
                    'get-news-paginated' => ['post'],
                    'get-hot-news' => ['post'],
                    'get-home-news' => ['post'],
                ],
            ],
            // KHÔNG có authenticator để public access
        ];
    }

    public function beforeAction($action)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        return parent::beforeAction($action);
    }

    /**
     * API lấy tất cả tin tức (có phân trang mặc định)
     */
    public function actionGetAllNews()
    {
        try {
            $query = News::find()
                ->where(['active' => 1, 'pheduyet' => 1])
                ->orderBy(['posted_date' => SORT_DESC, 'id' => SORT_DESC]);

            $news = $query->all();

            $result = [];
            foreach ($news as $item) {
                $result[] = $this->formatNewsItem($item);
            }

            return [
                'status' => true,
                'data' => $result,
                'count' => count($result),
                'message' => 'Lấy danh sách tin tức thành công'
            ];

        } catch (\Exception $e) {
            Yii::error('Lỗi khi lấy tin tức: ' . $e->getMessage());
            return [
                'status' => false,
                'message' => 'Có lỗi xảy ra khi lấy tin tức'
            ];
        }
    }

    /**
     * API lấy tin tức theo ID
     */
    private function formatNewsDetail($news)
    {
        $baseUrl = "https://benhvienquany7.vn";

        return [
            'id' => (int)$news->id,
            'title' => $news->title,
            'brief' => $news->brief,
            'content' => $this->processContentMedia($news->content, $baseUrl),
            'image' => $news->image ? $baseUrl . $news->image : null,
            'url' => $news->url,
            'posted_date' => $news->posted_date,
            'hot' => (bool)$news->hot,
            'home' => (bool)$news->home,
            'views' => (int)$news->luotxem,
            'category' => [
                'id' => $news->catNew ? (int)$news->catNew->id : null,
                'name' => $news->catNew ? $news->catNew->name : null,
                'url' => $news->catNew ? $news->catNew->url : null,
            ],
            'tags' => $news->tags,
            'seo_title' => $news->seo_title,
            'seo_keywords' => $news->seo_keyword,
            'seo_description' => $news->seo_desc,
            'link' => $news->getLink(),
            'full_url' => $news->getUrl(),
            'author_id' => (int)$news->lang_id,
            'status' => [
                'active' => (bool)$news->active,
                'approved' => (bool)$news->pheduyet,
            ]
        ];
    }

    private function processContentMedia($content, $baseUrl)
    {
        if (empty($content)) {
            return $content;
        }

        // Danh sách các thẻ cần xử lý
        $tagsToProcess = ['img', 'iframe', 'source', 'video', 'audio', 'embed'];

        foreach ($tagsToProcess as $tag) {
            $content = $this->processTagSrc($content, $tag, $baseUrl);
        }

        return $content;
    }

    private function processTagSrc($content, $tag, $baseUrl)
    {
        // Pattern để tìm các thẻ với src bắt đầu bằng /
        $pattern = '/<' . $tag . '([^>]*?)src="\/([^"]*?)"([^>]*?)>/i';
        $replacement = '<' . $tag . '$1src="' . $baseUrl . '/$2"$3>';

        return preg_replace($pattern, $replacement, $content);
    }

    /**
     * API lấy tin tức phân trang
     */
    public function actionGetNewsPaginated()
    {
        try {
            $data = Yii::$app->request->post();
            $page = isset($data['page']) ? (int)$data['page'] : 1;
            $pageSize = isset($data['pageSize']) ? (int)$data['pageSize'] : 10;
            $categoryId = isset($data['category_id']) ? (int)$data['category_id'] : null;
            $isHot = isset($data['is_hot']) ? (int)$data['is_hot'] : null;
            $isHome = isset($data['is_home']) ? (int)$data['is_home'] : null;

            // Xây dựng query
            $query = News::find()
                ->where(['active' => 1, 'pheduyet' => 1]);

            // Lọc theo danh mục
            if ($categoryId !== null) {
                $query->andWhere(['cat_new_id' => $categoryId]);
            }

            // Lọc tin nóng
            if ($isHot !== null) {
                $query->andWhere(['hot' => $isHot]);
            }

            // Lọc tin trang chủ
            if ($isHome !== null) {
                $query->andWhere(['home' => $isHome]);
            }

            $query->orderBy(['posted_date' => SORT_DESC, 'id' => SORT_DESC]);

            // Tính tổng số bản ghi
            $totalCount = $query->count();

            // Phân trang
            $totalPages = ceil($totalCount / $pageSize);
            $offset = ($page - 1) * $pageSize;

            $news = $query->offset($offset)
                ->limit($pageSize)
                ->all();

            $result = [];
            foreach ($news as $item) {
                $result[] = $this->formatNewsItem($item);
            }

            return [
                'status' => true,
                'data' => $result,
                'pagination' => [
                    'currentPage' => $page,
                    'pageSize' => $pageSize,
                    'totalCount' => $totalCount,
                    'totalPages' => $totalPages
                ],
                'filters' => [
                    'category_id' => $categoryId,
                    'is_hot' => $isHot,
                    'is_home' => $isHome
                ],
                'message' => 'Lấy danh sách tin tức phân trang thành công'
            ];

        } catch (\Exception $e) {
            Yii::error('Lỗi khi lấy tin tức phân trang: ' . $e->getMessage());
            return [
                'status' => false,
                'message' => 'Có lỗi xảy ra khi lấy tin tức'
            ];
        }
    }

    /**
     * Format dữ liệu tin tức cho danh sách
     */
    private function formatNewsItem($news)
    {
        $baseUrl = Yii::$app->request->hostInfo;

        return [
            'id' => (int)$news->id,
            'title' => $news->title,
            'brief' => $news->brief,
            'image' => $news->image ? $baseUrl.$news->image : null,
            'url' => $news->url,
            'posted_date' => $news->posted_date,
            'hot' => (bool)$news->hot,
            'home' => (bool)$news->home,
            'views' => (int)$news->luotxem,
            'category' => [
                'id' => $news->catNew ? (int)$news->catNew->id : null,
                'name' => $news->catNew ? $news->catNew->name : null,
                'url' => $news->catNew ? $news->catNew->url : null,
            ],
            'tags' => $news->tags,
            'seo_title' => $news->seo_title,
            'seo_description' => $news->seo_desc,
            'link' => $news->getLink(),
            'full_url' => $news->getUrl(),
        ];
    }

    /**
     * API lấy tin nóng (hot news)
     */
    public function actionGetHotNews()
    {
        try {
            $data = Yii::$app->request->post();
            $limit = isset($data['limit']) ? (int)$data['limit'] : 10;

            $news = News::find()
                ->where(['active' => 1, 'pheduyet' => 1, 'hot' => 1, 'cat_new_id' => 49])
                ->orderBy(['id' => SORT_DESC])
                ->limit($limit)
                ->all();

            $result = [];
            foreach ($news as $item) {
                $result[] = $this->formatNewsItem($item);
            }

            return [
                'status' => true,
                'data' => $result,
                'count' => count($result),
                'message' => 'Lấy danh sách tin nóng thành công'
            ];

        } catch (\Exception $e) {
            Yii::error('Lỗi khi lấy tin nóng: ' . $e->getMessage());
            return [
                'status' => false,
                'message' => 'Có lỗi xảy ra khi lấy tin nóng'
            ];
        }
    }

    public function actionGetNewsById()
    {
        try {
            $data = Yii::$app->request->post();

            if (!isset($data['id'])) {
                return [
                    'status' => false,
                    'message' => 'Thiếu tham số ID'
                ];
            }

            $id = (int)$data['id'];

            $news = News::find()
                ->where(['id' => $id, 'active' => 1, 'pheduyet' => 1])
                ->one();

            if ($news) {
                // Tăng lượt xem
                $news->luotxem = ($news->luotxem ?: 0) + 1;
                $news->save(false);

                return [
                    'status' => true,
                    'data' => $this->formatNewsDetail($news),
                    'message' => 'Lấy tin tức thành công'
                ];
            } else {
                return [
                    'status' => false,
                    'message' => 'Không tìm thấy tin tức với ID: ' . $id
                ];
            }

        } catch (\Exception $e) {
            Yii::error('Lỗi khi lấy tin tức theo ID: ' . $e->getMessage());
            return [
                'status' => false,
                'message' => 'Có lỗi xảy ra khi lấy tin tức' . $e->getMessage()
            ];
        }
    }
    /**
     * API lấy tin trang chủ (home news)
     */
    public function actionGetHomeNews()
    {
        try {
            $data = Yii::$app->request->post();
            $limit = isset($data['limit']) ? (int)$data['limit'] : 10;

            $news = News::find()
                ->where(['active' => 1, 'pheduyet' => 1, 'home' => 1])
                ->orderBy(['posted_date' => SORT_DESC])
                ->limit($limit)
                ->all();

            $result = [];
            foreach ($news as $item) {
                $result[] = $this->formatNewsItem($item);
            }

            return [
                'status' => true,
                'data' => $result,
                'count' => count($result),
                'message' => 'Lấy danh sách tin trang chủ thành công'
            ];

        } catch (\Exception $e) {
            Yii::error('Lỗi khi lấy tin trang chủ: ' . $e->getMessage());
            return [
                'status' => false,
                'message' => 'Có lỗi xảy ra khi lấy tin trang chủ'
            ];
        }
    }
}