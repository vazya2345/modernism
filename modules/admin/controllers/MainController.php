<?php

namespace app\modules\admin\controllers;

use app\models\Main;
use app\models\MainSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * MainController implements the CRUD actions for Main model.
 */
class MainController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Main models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new MainSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Main model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Main model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Main();

        if ($this->request->isPost) {
            if($model->load($this->request->post())){
                //photo
                if(isset($model->imageFile)){
                    $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
                    if($model->imageFile){
                        $imageFilename = 'main/image/' . time().'.'.$model->imageFile->extension;
                        if($model->imageFile->extension != NULL){
                            if ($model->uploadImage($imageFilename)) {
                                $model->photo_url = $imageFilename;
                                $model->imageFile = null;
                            }
                        }    
                    }
                }
                
                

                //video
                if(isset($model->videoFile)){
                    $model->videoFile = UploadedFile::getInstance($model, 'videoFile');
                    if($model->videoFile){
                        $videoFilename = 'main/video/' . time().'.'.$model->videoFile->extension;
                        if($model->videoFile->extension != NULL){
                            if ($model->uploadVideo($videoFilename)) {
                                $model->video_presentation_url = $videoFilename;
                                $model->videoFile = null;
                            }
                        } 
                    }
                }

                    

                //threed
                if(isset($model->threedFile)){
                    $model->threedFile = UploadedFile::getInstance($model, 'threedFile');
                    if($model->threedFile){
                        $threedFilename = 'main/threed/' . time().'.'.$model->threedFile->extension;
                        if($model->threedFile->extension != NULL){
                            if ($model->uploadThreed($threedFilename)) {
                                $model->threed_model_url = $threedFilename;
                                $model->threedFile = null;
                            }
                        }
                    }
                }

                

                if ($model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Main model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post())) {

             //photo
                $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
                // var_dump($model->imageFile);die;
                $imageFilename = 'main/image/' . time().'.'.$model->imageFile->extension;
                if($model->imageFile->extension != NULL){
                    if ($model->uploadImage($imageFilename)) {
                        $model->photo_url = $imageFilename;
                        $model->imageFile = null;
                    }
                }

                //video
                $model->videoFile = UploadedFile::getInstance($model, 'videoFile');
                $videoFilename = 'main/video/' . time().'.'.$model->videoFile->extension;
                if($model->videoFile->extension != NULL){
                    if ($model->uploadVideo($videoFilename)) {
                        $model->video_presentation_url = $videoFilename;
                        $model->videoFile = null;
                    }
                }

                //threed
                $model->threedFile = UploadedFile::getInstance($model, 'threedFile');

                $threedFilename = 'main/threed/' . time().'.'.$model->threedFile->extension;
                if($model->threedFile->extension != NULL){
                    if ($model->uploadThreed($threedFilename)) {
                        $model->threed_model_url = $threedFilename;
                        $model->threedFile = null;
                    }
                }

                if ($model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Main model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Main model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Main the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Main::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
