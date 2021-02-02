<?php

namespace app\controllers;

use app\models\Equipos;
use Yii;
use app\models\Fotos;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * FotosController implements the CRUD actions for Fotos model.
 */
class FotosController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],

                ],
            ],
            'access' => [
                'class' => AccessControl::class,
                'only' => [
                    'create'
                ],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['create'],
                        'matchCallback' => function ($rule, $action) {

                            if (Yii::$app->user->isGuest) {
                                Yii::$app->session->setFlash('error', '¡No puedes subir una foto sin iniciar sesión!');
                                return false;
                            }

                            if (Yii::$app->user->identity->id !== 1) {
                                Yii::$app->session->setFlash('error', '¡Solo el administrador puede subir fotos!');
                                return false;
                            }

                            // OPCIÓN PARA CUANDO LOS USUARIOS TENGAN PERMISOS PARA SUBIR IMÁGENES
                            // if (!Yii::$app->user->identity->esValidado()) {
                            //     Yii::$app->session->setFlash('error', '¡Tienes que validar tu usuario para subir una foto!');
                            //     //TODO: debería redirigir a un enlace para la validación
                            //     return false;
                            // }

                            return true;
                        }
                    ],
                ],
            ]
        ];
    }

    /**
     * Lists all Fotos models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Fotos::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Fotos model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Fotos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Fotos();

        if ($model->load(Yii::$app->request->post())) {
            $model->imagen = UploadedFile::getInstance($model, 'imagen');

            if($model->imagen) {

                $model->imagen_nombre = $model->imagen->baseName . '.' . $model->imagen->extension;
                
                $model->imagen_url = 'media/imagenes/' . $model->imagen_nombre . '.' . $model->imagen->extension;
                
                if ($model->validate()) {
                    
                    if ($model->imagen->saveAs('media/imagenes/' . $model->imagen->baseName . '.' . $model->imagen->extension)) {

                        if ($model->save()) {

                            //TODO: Disparador que corrija que todas las imágenes tienen su correspondiente registro
                            // en la base de datos y borre las que sobren. Esto controlará el peso de las carpetas

                            return $this->redirect(['view', 'id' => $model->id]);
                        }

                    }

                    Yii::$app->session->setFlash('error', '¡La imagen no se guardó correctamente!');

                }
            
            } else {

                Yii::$app->session->setFlash('error', '¡No has seleccionado ninguna imágen!');
            }
            
        }

        return $this->render('create', [
            'model' => $model,
            'equiposId' => Equipos::find()->select('id')->column(),
        ]);
    }

    /**
     * Updates an existing Fotos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //TODO: Disparador que corrija que todas las imágenes tienen su correspondiente registro
            // en la base de datos y borre las que sobren. Esto controlará el peso de las carpetas

            //TODO: actualizar la foto si es necesario (total, no funciona ahora mismo)

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Fotos model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        //TODO: Disparador que corrija que todas las imágenes tienen su correspondiente registro
        // en la base de datos y borre las que sobren. Esto controlará el peso de las carpetas

        return $this->redirect(['index']);
    }

    /**
     * Finds the Fotos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Fotos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Fotos::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
