<div class="kv-detail-content">
    <h3>User Company Verification Details</h3>
    <div class="row">
        <div class="col-xs-12">
            <table class="table table-bordered">
                <thead>
                <tr role="row" class="heading">
                    <th width="25%">
                        Company Registration Certificate
                    </th>
                    <th width="25%">
                        VAT Document
                    </th>
                    <th width="25%">
                        Supplier/Utility Invoice
                    </th>
                    <th width="25%">
                        Picture/Brochure of Shop
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        <a>
                            <img class="img-responsive h_myimg" src="<?=Yii::$app->urlManagerFrontend->baseUrl.$model->company_registration_certificate?>" alt="">
                        </a>
                    </td>

                    <td>
                        <a>
                            <img class="img-responsive h_myimg" src="<?=Yii::$app->urlManagerFrontend->baseUrl.$model->vat_document?>" alt="">
                        </a>
                    </td>

                    <td>
                        <a>
                            <img class="img-responsive h_myimg" src="<?=Yii::$app->urlManagerFrontend->baseUrl.$model->supplier_invoice?>" alt="">
                        </a>
                    </td>

                    <td>
                        <a>
                            <img class="img-responsive h_myimg" src="<?=Yii::$app->urlManagerFrontend->baseUrl.$model->shop_picture?>" alt="">
                        </a>
                    </td>
                </tr>

                </tbody>
            </table>
        </div>
    </div>
</div>


