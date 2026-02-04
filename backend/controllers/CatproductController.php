<?php

namespace backend\controllers;


use common\models\Detailproperties;
use Yii;
use common\models\Catproduct;
use common\models\search\CatproductSearch;
use yii\filters\AccessControl;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\web\UploadedFile;

/**
 * CatproductController implements the CRUD actions for Catproduct model.
 */
class CatproductController extends Controller
{
    /**
     * @inheritdoc
     */

    /**
     * Lists all Catproduct models.
     * @return mixed
     */
    public function actionIndex()
    {
        $data = Catproduct::find()->orderBy(['ord' => SORT_ASC])->all();
        $searchModel = new CatproductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->sort =  [
            'defaultOrder' => [
                'parent' => SORT_ASC,
                'id' => SORT_DESC,
            ]];
        return $this->render('index', [
            'data' => $data,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }




    /**
     * Displays a single Catproduct model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $request = Yii::$app->request;
        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'title' => "Catproduct #" . $id,
                'content' => $this->renderAjax('view', [
                    'model' => $this->findModel($id),
                ]),
                'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                    Html::a('Edit', ['update', 'id' => $id], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
            ];
        } else {
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
    }

    /**
     * Creates a new Catproduct model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */

    public function actionCattree()
    {
        $data = Catproduct::find()->orderBy(['ord' => SORT_ASC])->all();

        return $this->render('cattree', [
            'data' => $data,
        ]);
    }

    public function actionTaomoi()
    {
        $request = Yii::$app->request;
        $model = new Catproduct();
        $model->ord=99999;
        if(isset($_GET['parent'])){
            $model->parent=(int)$_GET['parent'];
        }
        $property = new Detailproperties();
        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => 'Tạo mới danh mục sản phẩm',
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                        'property'=>$property,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            } else if ($model->load($request->post())) {

                $file = UploadedFile::getInstance($model, 'image');
                if (!is_null($file)) {
                    $model->image =  '/images/catproduct/' .\func::taoduongdan(time() . "-" . $file->name);
                }

                if ($model->save()) {
                    Catproduct::updateAll(['url' =>  \func::taoduongdan($model->name)], 'id=:id', [':id' => $model->id]);
                    if (is_null($model->parent) || $model->parent == '')
                        Catproduct::updateAll(['parent' => -1], 'id=:id', [':id' => $model->id]);
                    if (!is_null($file)) {
                        $path = dirname(dirname(__DIR__)) . $model->image;
                        $file->saveAs($path);
                    }
                    return [
                        'forceReload' => '#p0',
                        'title' => "Tạo mới Danh mục",
                        'content' => '<span class="text-success">Tạo danh mục thành công</span>',
                        'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]).
                            Html::a('Create More', ['taomoi'], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
                    ];
                } else {
                    return [
                        'title' => "Tạo mới Danh mục",
                        'content' => $this->renderAjax('create', [
                            'model' => $model,
                            'property'=>$property
                        ]),
                        'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                            Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])

                    ];
                }
            }
        } else {
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                    'property'=>$property
                ]);
            }
        }
    }

    public function actionCapnhat($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        $oldfile = $model->image;

        $idproperty=[];
        foreach ($model->detailProperties as $property)
        {
            $idproperty[$property->properties_id]=$property->properties_id;
        }
        $property= new Detailproperties();
        // $property->setIsNewRecord(false);
        $property->properties_id=$idproperty;


        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => "Update Catproduct #" . $id,
                    'content' => $this->renderAjax('update', [
                        'model' => $model,
                        'property' =>$property,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            } else if ($model->load($request->post())) {

                $file = UploadedFile::getInstance($model, 'image');
                if (!is_null($file)) {
                    $model->image = '/images/catproduct/' .\func::taoduongdan(time() . "-" . $file->name);
                } else
                    $model->image = $oldfile;

                if ($model->save()) {
                    Catproduct::updateAll(['url' => \func::taoduongdan($model->name)], 'id=:id', [':id' => $model->id]);
                    if (is_null($model->parent) || $model->parent == '')
                        Catproduct::updateAll(['parent' => -1], 'id=:id', [':id' => $model->id]);

                    // upload anh
                    if (!is_null($file)) {
                        $path = dirname(dirname(__DIR__)) .  $model->image;
                        $file->saveAs($path);

                        $oldpath = dirname(dirname(__DIR__)) .  $oldfile;
                        if (is_file($oldpath))
                            unlink($oldpath);
                    }

                    return [
                        'forceReload' => '#p0',
                        'title' => "Catproduct #" . $id,
                        'content' => $this->renderAjax('view', [
                            'model' => $model,
                            'property' =>$property,

                        ]),
                        'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                            Html::a('Edit', ['update', 'id' => $id], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
                    ];
                }

            } else {
                return [
                    'title' => "Update Catproduct #" . $id,
                    'content' => $this->renderAjax('update', [
                        'model' => $model,
                        'property' =>$property,

                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            }
        } else {
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                    'property' =>$property,

                ]);
            }
        }
    }

    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new Catproduct();
        if(isset($_GET['parent'])){
            $model->parent=(int)$_GET['parent'];
        }
        $property = new Detailproperties();
        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => "Tạo mới Catproduct",
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                        'property'=>$property
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])

                ];
            } else
                if ($model->load($request->post())) {

                    $file = UploadedFile::getInstance($model, 'image');
                    if (!is_null($file)) {
                        $model->image = "/images/catproduct/".\func::taoduongdan(time() . "-" . $file->name);
                    }
                    if ($model->save()) {


                        Catproduct::updateAll(['url' => \func::taoduongdan($model->name)], 'id=:id', [':id' => $model->id]);
                        if (is_null($model->parent) || $model->parent == '')
                            Catproduct::updateAll(['parent' => -1], 'id=:id', [':id' => $model->id]);
                        if (!is_null($file)) {
                            $path = dirname(dirname(__DIR__)) .  $model->image;
                            $file->saveAs($path);
                        }
                        return [
                            'forceReload' => '#crud-datatable-pjax',
                            'title' => "Tạo mới Catproduct",
                            'content' => '<span class="text-success">Create Catproduct success</span>',
                            'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                                Html::a('Create More', ['create'], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])

                        ];
                    }

                } else {

                    return [
                        'title' => "Tạo mới Catproduct",
                        'content' => $this->renderAjax('create', [
                            'model' => $model,
                            'property'=>$property
                        ]),
                        'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                            Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])

                    ];
                }
        } else {
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                    'property'=>$property
                ]);
            }
        }

    }

    /**
     * Updates an existing Catproduct model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */



    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        $oldfile = $model->image;

        $idproperty=[];
        foreach ($model->detailProperties as $property)
        {
            $idproperty[$property->properties_id]=$property->properties_id;
        }
        $property= new Detailproperties();
        // $property->setIsNewRecord(false);
        $property->properties_id=$idproperty;

        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => "Update Catproduct #" . $id,
                    'content' => $this->renderAjax('update', [
                        'model' => $model,
                        'property' => $property,

                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            } else if ($model->load($request->post())) {

                $file = UploadedFile::getInstance($model, 'image');
                if (!is_null($file)) {
                    $model->image = "/images/catproduct/".\func::taoduongdan(time() . "-" . $file->name);
                } else
                    $model->image = $oldfile;
                if ($model->save()) {
                    Catproduct::updateAll(['url' => \func::taoduongdan($model->name)], 'id=:id', [':id' => $model->id]);
                    if (is_null($model->parent) || $model->parent == '')
                        Catproduct::updateAll(['parent' => -1], 'id=:id', [':id' => $model->id]);

                    // upload anh
                    if (!is_null($file)) {
                        $path = dirname(dirname(__DIR__))  . $model->image;
                        $file->saveAs($path);

                        $oldpath = dirname(dirname(__DIR__))  . $oldfile;
                        if (is_file($oldpath))
                            unlink($oldpath);
                    }
                    return [
                        'forceReload' => '#crud-datatable-pjax',
                        'title' => "Catproduct #" . $id,
                        'content' => $this->renderAjax('view', [
                            'model' => $model,
                            'property' => $property,
                        ]),
                        'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                            Html::a('Edit', ['update', 'id' => $id], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
                    ];
                }

            } else {
                return [
                    'title' => "Update Catproduct #" . $id,
                    'content' => $this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            }
        } else {
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                    'property' => $property,
                ]);
            }
        }
    }

    /**
     * Delete an existing Catproduct model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $request = Yii::$app->request;
        if($id!=30)
        Catproduct::deleteCat($id);

        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose' => true, 'forceReload' => '#crud-datatable-pjax'];
        } else {
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }


    }

    /**
     * Delete multiple existing Catproduct model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionBulkdelete()
    {
        $request = Yii::$app->request;
        $pks = explode(',', $request->post('pks')); // Array or selected records primary keys
        foreach ($pks as $pk) {
            $model = $this->findModel($pk);
            $model->delete();
        }

        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose' => true, 'forceReload' => '#crud-datatable-pjax'];
        } else {
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }

    }

    /**
     * Finds the Catproduct model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Catproduct the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Catproduct::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionUpdatehome()
    {
        $catproduct = Catproduct::find()->where(['id' => $_POST['id']])->one();
        Catproduct::updateAll(['home' => (1 - $catproduct->home)], ['id' => $catproduct->id]);
    }

    public function actionUpdateactive()
    {
        $catproduct = Catproduct::find()->where(['id' => $_POST['id']])->one();
        Catproduct::updateAll(['active' => (1 - $catproduct->active)], ['id' => $catproduct->id]);
    }

    public function actionUpdatemenu()
    {
        $catproduct = Catproduct::find()->where(['id' => $_POST['id']])->one();
        Catproduct::updateAll(['menu' => (1 - $catproduct->menu)], ['id' => $catproduct->id]);
    }

    public function actionUpdateparent()
    {
        $catproduct = Catproduct::find()->where(['id' => $_POST['id']])->one();
        Catproduct::updateAll(['parent' => $_POST['value']], ['id' => $catproduct->id]);
    }

    /* public function actionUpdateposition()
     {
         $catproduct = Catproduct::find()->where(['id'=>$_POST['id']])->one();
         Catproduct::updateAll(['position'=>$_POST['value']],['id'=>$catproduct->id]);
     }*/
    public function actionUpdateord()
    {
        $catproduct = Catproduct::find()->where(['id' => $_POST['id']])->one();
        Catproduct::updateAll(['ord' => $_POST['value']], ['id' => $catproduct->id]);
    }

    public function actionUpdatett()
    {
        \func::updateCatMenu('null', Json::decode($_POST['data']), 0);
        return var_dump(Json::decode($_POST['data']));
    }
    public function actionDeletecat(){
        \func::deleteCatMenu($_POST['id']);
        $cat = Catproduct::find()->where(['id'=>$_POST['id']])->one();
        $cat->delete();
        return 1;
    }
}
