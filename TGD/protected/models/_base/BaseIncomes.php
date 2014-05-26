<?php

/**
 * This is the model base class for the table "{{incomes}}".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Incomes".
 *
 * Columns in table "{{incomes}}" available as properties of the model,
 * followed by relations of table "{{incomes}}" available as properties of the model.
 *
 * @property integer $id
 * @property integer $type
 * @property string $source_name
 * @property string $gross_amount
 * @property string $expenses
 * @property string $income_date
 * @property integer $currency
 * @property string $xrate_usd_spot
 * @property string $loan_reserved
 * @property string $created_at
 * @property string $updated_at
 *
 * @property IncomesTypes $type0
 * @property Currencies $currency0
 */
abstract class BaseIncomes extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return '{{incomes}}';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Income|Income', $n);
	}

	public static function representingColumn() {
		return 'source_name';
	}

	public function rules() {
		return array(
			array('type, currency, loan_reserved', 'required'),
			array('type, currency, loan_reserved', 'numerical'),
			array('source_name', 'length', 'max'=>255),
			array('gross_amount, expenses, income_date, xrate_usd_spot, loan_reserved, created_at, updated_at', 'safe'),
			array('source_name, gross_amount, expenses, income_date, xrate_usd_spot, loan_reserved, created_at, updated_at', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, type, source_name, gross_amount, expenses, income_date, currency, xrate_usd_spot, loan_reserved, created_at, updated_at', 'safe', 'on'=>'search'),

		);
	}

	public function relations() {
		return array(
			'type0' => array(self::BELONGS_TO, 'IncomesTypes', 'type'),
			'currency0' => array(self::BELONGS_TO, 'Currencies', 'currency'),
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'type' =>Yii::t('app', 'Type'),
			'source_name' => Yii::t('app', 'Name'),
			'gross_amount' => Yii::t('app', 'Gross Amount'),
			'expenses' => Yii::t('app', 'Expenses'),
			'income_date' => Yii::t('app', 'Income Date'),
			'currency' => null,
			'xrate_usd_spot' => Yii::t('app', 'Xrate Usd Spot'),
			'loan_reserved' => Yii::t('app', 'Loan reserve (%)'),
			'created_at' => Yii::t('app', 'Created At'),
			'updated_at' => Yii::t('app', 'Updated At'),
			'type0' => null,
			'currency0' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('type', $this->type);
		$criteria->compare('source_name', $this->source_name, true);
		$criteria->compare('gross_amount', $this->gross_amount, true);
		$criteria->compare('expenses', $this->expenses, true);
		$criteria->compare('income_date', $this->income_date, true);
		$criteria->compare('currency', $this->currency);
		$criteria->compare('xrate_usd_spot', $this->xrate_usd_spot, true);
		$criteria->compare('loan_reserved', $this->loan_reserved, true);
		$criteria->compare('created_at', $this->created_at, true);
		$criteria->compare('updated_at', $this->updated_at, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}