<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "expert".
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $mobile
 * @property string $description
 * @property int $user_id
 *
 * @property ProjectExpert[] $projectExperts
 */
class Expert extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'expert';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['user_id'], 'integer'],
            [['user_id'], 'unique'],
            [['email'], 'email'],
            [['name', 'email', 'mobile'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Прізвище, ім*я',
            'email' => 'Почта еmail',
            'mobile' => 'Телефон',
            'description' => 'Посада',
            'user_id' => 'User ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectExperts()
    {
        return $this->hasMany(ProjectExpert::className(), ['expert_id' => 'id']);
    }

    public function getProjects()
    {
        return $this->hasMany(Project::className(), ['id' => 'project_id'])
            ->viaTable('project_expert', ['expert_id' => 'id']);
    }
    public function getUser(){
        return $this->hasOne(User::className(), ['id'=>'user_id']);
    }
    public function saveUser($user_id){
        $user = User::findOne($user_id);
        if($user !=null){
            $this->link('user', $user);
            return true;
        }
    }
    /**
     * @param string $view
     * @param string $subject
     * @param array $params
     * @return bool
     */
    public function sendMailForAdmin($view, $subject, $params = []) {
        // Set layout params


        Yii::$app->mailer->getView()->params['userName'] = 'Admin';

        $result = Yii::$app->mailer->compose([
            'html' => 'views/' . $view . '-html',
            'text' => 'views/' . $view . '-text',

        ], $params)->setTo([$this->email='admin.vbe@ukr.net' => $this->name='Admin'])
            ->setSubject($subject)
            ->attach('../documentsWord/' . $params['paramExample'] . '_' . $params['project'] . '.docx')

            ->send();

       // $mailer->AddAttachment('/home/mywebsite/public_html/file.zip', 'file.zip');
//          $result->attach('web/doc.docx');
        // Reset layout params
        Yii::$app->mailer->getView()->params['userName'] = null;

        return $result;
    }
    public function sendMailForExpert($view, $subject, $params = []) {
        // Set layout params


        Yii::$app->mailer->getView()->params['userName'] = $this->name;

        $result = Yii::$app->mailer->compose([
            'html' => 'views/' . $view . '-html',
            'text' => 'views/' . $view . '-text',

        ], $params)->setTo([$this->email => $this->name])
            ->setSubject($subject)
            // ->attach('../documentsWord/' . $params['paramExample'] . '_' . $params['project'] . '.docx')

            ->send();

        // $mailer->AddAttachment('/home/mywebsite/public_html/file.zip', 'file.zip');
//          $result->attach('web/doc.docx');
        // Reset layout params
        Yii::$app->mailer->getView()->params['userName'] = null;

        return $result;
    }

}
