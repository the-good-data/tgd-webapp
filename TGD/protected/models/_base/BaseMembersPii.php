<?php

/**
 * This is the model base class for the table "{{members_pii}}".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "MembersPii".
 *
 * Columns in table "{{members_pii}}" available as properties of the model,
 * and there are no model relations.
 *
 * @property string $id
 * @property string $firstname
 * @property string $lastname
 * @property string $streetname
 * @property string $streetnumber
 * @property string $streetdetails
 * @property string $city
 * @property string $statecounty
 * @property string $country
 * @property string $postcode
 * @property string $daybirthday
 * @property string $monthbirthday
 * @property string $yearbirthday
 * @property boolean $agree
 * @property string $created_at
 * @property string $updated_at
 *
 */
abstract class BaseMembersPii extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return '{{members_pii}}';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'MembersPii|MembersPiis', $n);
	}

	public static function representingColumn() {
		return 'firstname';
	}

	public function rules() {
		return array(
			array('id, firstname, lastname, streetname, streetnumber, city, statecounty, country, postcode, daybirthday, monthbirthday, yearbirthday, agree', 'required'),
			array('id', 'length', 'max'=>128),
			array('firstname, lastname, streetname, streetnumber, streetdetails, city, statecounty, country, postcode, daybirthday, monthbirthday, yearbirthday', 'length', 'max'=>256),
			array('created_at, updated_at', 'safe'),
			array('created_at, updated_at', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, firstname, lastname, streetname, streetnumber, streetdetails, city, statecounty, country, postcode, daybirthday, monthbirthday, yearbirthday, agree, created_at, updated_at', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'firstname' => Yii::t('app', 'Firstname'),
			'lastname' => Yii::t('app', 'Lastname'),
			'streetname' => Yii::t('app', 'Streetname'),
			'streetnumber' => Yii::t('app', 'Street number'),
			'streetdetails' => Yii::t('app', 'Street details'),
			'city' => Yii::t('app', 'City'),
			'statecounty' => Yii::t('app', 'State/county'),
			'country' => Yii::t('app', 'Country'),
			'postcode' => Yii::t('app', 'Postcode'),
			'daybirthday' => Yii::t('app', 'Day birthday'),
			'monthbirthday' => Yii::t('app', 'Month birthday'),
			'yearbirthday' => Yii::t('app', 'Year birthday'),
			'agree' => Yii::t('app', 'Agree'),
			'created_at' => Yii::t('app', 'Created At'),
			'updated_at' => Yii::t('app', 'Updated At'),
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id, true);
		$criteria->compare('firstname', $this->firstname, true);
		$criteria->compare('lastname', $this->lastname, true);
		$criteria->compare('streetname', $this->streetname, true);
		$criteria->compare('streetnumber', $this->streetnumber, true);
		$criteria->compare('streetdetails', $this->streetdetails, true);
		$criteria->compare('city', $this->city, true);
		$criteria->compare('statecounty', $this->statecounty, true);
		$criteria->compare('country', $this->country, true);
		$criteria->compare('postcode', $this->postcode, true);
		$criteria->compare('daybirthday', $this->daybirthday, true);
		$criteria->compare('monthbirthday', $this->monthbirthday, true);
		$criteria->compare('yearbirthday', $this->yearbirthday, true);
		$criteria->compare('agree', $this->agree);
		$criteria->compare('created_at', $this->created_at, true);
		$criteria->compare('updated_at', $this->updated_at, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}