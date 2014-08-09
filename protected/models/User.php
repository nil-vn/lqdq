<?php

/**
 * This is the model class for table "abonnement_decouverte".
 *
 * The followings are the available columns in table 'abonnement_decouverte':
 * @property string $id
 * @property integer $id_annonce
 * @property string $date_creation
 * @property string $date_maj
 * @property integer $valide
 * @property string $desinscription_date
 * @property string $desinscription_commentaire
 * @property string $ip
 * @property string $relance_date
 * @property integer $relance_nb
 */
class User extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'lq_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	// public function rules()
	// {
	// 	// NOTE: you should only define rules for those attributes that
	// 	// will receive user inputs.
	// 	return array(
	// 		array('id_annonce, date_creation, date_maj', 'required'),
	// 		array('id_annonce, valide, relance_nb', 'numerical', 'integerOnly'=>true),
	// 		array('desinscription_commentaire', 'length', 'max'=>1000),
	// 		array('ip', 'length', 'max'=>50),
	// 		array('desinscription_date, relance_date', 'safe'),
	// 		// The following rule is used by search().
	// 		// @todo Please remove those attributes that should not be searched.
	// 		array('id, id_annonce, date_creation, date_maj, valide, desinscription_date, desinscription_commentaire, ip, relance_date, relance_nb', 'safe', 'on'=>'search'),
	// 	);
	// }

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	// public function attributeLabels()
	// {
	// 	return array(
	// 		'id' => 'ID',
	// 		'id_annonce' => 'Id Annonce',
	// 		'date_creation' => 'Date Creation',
	// 		'date_maj' => 'Date Maj',
	// 		'valide' => 'Valide',
	// 		'desinscription_date' => 'Desinscription Date',
	// 		'desinscription_commentaire' => 'Desinscription Commentaire',
	// 		'ip' => 'Ip',
	// 		'relance_date' => 'Relance Date',
	// 		'relance_nb' => 'Relance Nb',
	// 	);
	// }

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	// public function search()
	// {
	// 	// @todo Please modify the following code to remove attributes that should not be searched.

	// 	$criteria=new CDbCriteria;

	// 	$criteria->compare('id',$this->id,true);
	// 	$criteria->compare('id_annonce',$this->id_annonce);
	// 	$criteria->compare('date_creation',$this->date_creation,true);
	// 	$criteria->compare('date_maj',$this->date_maj,true);
	// 	$criteria->compare('valide',$this->valide);
	// 	$criteria->compare('desinscription_date',$this->desinscription_date,true);
	// 	$criteria->compare('desinscription_commentaire',$this->desinscription_commentaire,true);
	// 	$criteria->compare('ip',$this->ip,true);
	// 	$criteria->compare('relance_date',$this->relance_date,true);
	// 	$criteria->compare('relance_nb',$this->relance_nb);

	// 	return new CActiveDataProvider($this, array(
	// 		'criteria'=>$criteria,
	// 	));
	// }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AbonnementDecouverte the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
