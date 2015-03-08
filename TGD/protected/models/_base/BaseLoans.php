<?php

/**
 * This is the model base class for the table "{{loans}}".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Loans".
 *
 * Columns in table "{{loans}}" available as properties of the model,
 * followed by relations of table "{{loans}}" available as properties of the model.
 *
 * @property integer $id
 * @property string $loan_identifier
 * @property integer $leader
 * @property string $loan_url
 * @property string $title_en
 * @property string $title_es
 * @property integer $id_loans_activity
 * @property integer $id_countries
 * @property string $partner
 * @property double $amount
 * @property integer $currency
 * @property integer $term
 * @property double $contribution
 * @property double $paidback
 * @property double $loss
 * @property integer $id_loans_status
 * @property string $image
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Currencies $currency0
 * @property Countries $idCountries
 * @property LoansActivities $idLoansActivity
 * @property LoansStatus $idLoansStatus
 * @property LoansLeaders $leader0
 */
abstract class BaseLoans extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return '{{loans}}';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Loans|Loans', $n);
	}

	public static function representingColumn() {
		return 'loan_identifier';
	}

	public function rules() {
		return array(
			array('leader, id_loans_activity, id_countries, currency, id_loans_status', 'required'),
			array('leader, id_loans_activity, id_countries, currency, term, id_loans_status', 'numerical', 'integerOnly'=>true),
			array('amount, contribution, paidback, loss', 'numerical'),
			array('loan_identifier, loan_url, title_en, title_es, partner, image', 'length', 'max'=>255),
			array('created_at, updated_at', 'safe'),
			array('loan_identifier, loan_url, title_en, title_es, partner, amount, term, contribution, paidback, loss, image, created_at, updated_at', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, loan_identifier, leader, loan_url, title_en, title_es, id_loans_activity, id_countries, partner, amount, currency, term, contribution, paidback, loss, id_loans_status, image, created_at, updated_at', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'currency0' => array(self::BELONGS_TO, 'Currencies', 'currency'),
			'idCountries' => array(self::BELONGS_TO, 'Countries', 'id_countries'),
			'idLoansActivity' => array(self::BELONGS_TO, 'LoansActivities', 'id_loans_activity'),
			'idLoansStatus' => array(self::BELONGS_TO, 'LoansStatus', 'id_loans_status'),
			'leader0' => array(self::BELONGS_TO, 'LoansLeaders', 'leader'),
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'loan_identifier' => Yii::t('app', 'Loan Identifier'),
			'leader' => null,
			'loan_url' => Yii::t('app', 'Loan Url'),
			'title_en' => Yii::t('app', 'Title En'),
			'title_es' => Yii::t('app', 'Title Es'),
			'id_loans_activity' => null,
			'id_countries' => null,
			'partner' => Yii::t('app', 'Partner'),
			'amount' => Yii::t('app', 'Amount'),
			'currency' => null,
			'term' => Yii::t('app', 'Term'),
			'contribution' => Yii::t('app', 'Contribution'),
			'paidback' => Yii::t('app', 'Paidback'),
			'loss' => Yii::t('app', 'Loss'),
			'id_loans_status' => null,
			'image' => Yii::t('app', 'Image'),
			'created_at' => Yii::t('app', 'Created At'),
			'updated_at' => Yii::t('app', 'Updated At'),
			'currency0' => null,
			'idCountries' => null,
			'idLoansActivity' => null,
			'idLoansStatus' => null,
			'leader0' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('loan_identifier', $this->loan_identifier, true);
		$criteria->compare('leader', $this->leader);
		$criteria->compare('loan_url', $this->loan_url, true);
		$criteria->compare('title_en', $this->title_en, true);
		$criteria->compare('title_es', $this->title_es, true);
		$criteria->compare('id_loans_activity', $this->id_loans_activity);
		$criteria->compare('id_countries', $this->id_countries);
		$criteria->compare('partner', $this->partner, true);
		$criteria->compare('amount', $this->amount);
		$criteria->compare('currency', $this->currency);
		$criteria->compare('term', $this->term);
		$criteria->compare('contribution', $this->contribution);
		$criteria->compare('paidback', $this->paidback);
		$criteria->compare('loss', $this->loss);
		$criteria->compare('id_loans_status', $this->id_loans_status);
		$criteria->compare('image', $this->image, true);
		$criteria->compare('created_at', $this->created_at, true);
		$criteria->compare('updated_at', $this->updated_at, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}