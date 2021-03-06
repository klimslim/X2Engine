<?php
/*********************************************************************************
 * The X2CRM by X2Engine Inc. is free software. It is released under the terms of 
 * the following BSD License.
 * http://www.opensource.org/licenses/BSD-3-Clause
 * 
 * X2Engine Inc.
 * P.O. Box 66752
 * Scotts Valley, California 95066 USA
 * 
 * Company website: http://www.x2engine.com 
 * Community and support website: http://www.x2community.com 
 * 
 * Copyright © 2011-2012 by X2Engine Inc. www.X2Engine.com
 * All rights reserved.
 * 
 * Redistribution and use in source and binary forms, with or without modification, 
 * are permitted provided that the following conditions are met:
 * 
 * - Redistributions of source code must retain the above copyright notice, this 
 *   list of conditions and the following disclaimer.
 * - Redistributions in binary form must reproduce the above copyright notice, this 
 *   list of conditions and the following disclaimer in the documentation and/or 
 *   other materials provided with the distribution.
 * - Neither the name of X2Engine or X2CRM nor the names of its contributors may be 
 *   used to endorse or promote products derived from this software without 
 *   specific prior written permission.
 * 
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND 
 * ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED 
 * WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. 
 * IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, 
 * INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, 
 * BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, 
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF 
 * LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE 
 * OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED 
 * OF THE POSSIBILITY OF SUCH DAMAGE.
 ********************************************************************************/

/**
 * This is the model class for table "x2_contacts".
 *
 * The followings are the available columns in table 'x2_contacts':
 * @property integer $id
 * @property string $firstName
 * @property string $lastName
 * @property string $title
 * @property string $company
 * @property integer $accountId
 * @property string $phone
 * @property string $phone2
 * @property string $email
 * @property string $website
 * @property string $address
 * @property string $city
 * @property string $state
 * @property string $zipcode
 * @property string $country
 * @property integer $visibility
 * @property string $assignedTo
 * @property string $backgroundInfo
 * @property string $twitter
 * @property string $linkedin
 * @property string $skype
 * @property string $googleplus
 * @property string $lastUpdated
 * @property string $updatedBy
 * @property string $priority
 * @property string $leadSource
 * @property integer $rating
 * @property integer $createDate
 * @property string $facebook
 * @property string $otherUrl
 * @property string $newField
 */
class Contacts extends CActiveRecord {

	private $_fields;

	public function init() {
		$this->_fields = Yii::app()->db->createCommand()->select('*')->from('x2_fields')->where('modelName="Contacts"')->queryAll();
	}
	
	
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return Contacts the static model class
	 */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return 'x2_contacts';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
			// varchar	
			// text
			// date
			// dropdown
			// int	
			// email
			// currency
			// url
			// float
			// boolean
			// required
		// $validators = array( );
		
		// foreach( $this->fields as &$field ) {
		
			// switch( $field['type'] ) {
				// case 'varchar':
				// case 'text':
				// case 'url':
				// case 'currency':
				// case 'dropdown':
					// $validators['safe'][] = $field['fieldName'];	// these field types have no rules, but still need to be allowed
					// break;
				// case 'date':
					// $validators['int'][] = $field['fieldName'];		// date is actually an int
					// break;
				// default:
					// $validators[ $field['type'] ][] = $field['fieldName'];		// otherwise use the type as the validator name
			// }
			
			// if( $field['required'] )
				// $validators['required'][] = $field['fieldName'];
		// }
			
		
		
		// $rules =  array(
			// array( implode( ',', $validators['required']), 'required' ),
			// array( implode( ',', $validators['email']), 'email' ),
			// array( implode( ',', array_merge($validators['int'],$validators['date']) ), 'numerical', 'integerOnly'=>true ),
			// array( implode( ',', $validators['float']), 'numerical' ),
			// array( implode( ',', $validators['boolean']), 'boolean' ),
			// array( implode( ',', $validators['safe']), 'safe' ),
		// );

		// return $rules;
		
		
		
		// old version
		$fields = Fields::model()->findAllByAttributes(array('modelName'=>get_class($this)));
		$arr=array(
			'varchar'=>array(),
			'text'=>array(),
			'date'=>array(),
			'dropdown'=>array(),
			'int'=>array(),
			'email'=>array(),
			'currency'=>array(),
			'url'=>array(),
			'float'=>array(),
			'boolean'=>array(),
			'required'=>array(),
			
		);
		$rules=array();
		foreach($fields as $field){
			$arr[$field->type][]=$field->fieldName;
			if($field->required)
				$arr['required'][]=$field->fieldName;
                        if($field->type!='date')
                            $arr['search'][]=$field->fieldName;
		}
                $arr['search'][]='name';
		foreach($arr as $key=>$array){
			switch($key){
				case 'email':
					$rules[]=array(implode(',',$array),$key);
					break;
				case 'required':
					$rules[]=array(implode(',',$array),$key);
					break;
                                case 'search':
                                        $rules[]=array(implode(",",$array),'safe','on'=>'search');
                                        break;
				case 'int':
					$rules[]=array(implode(',',$array),'numerical','integerOnly'=>true);
					break;
				case 'float':
					$rules[]=array(implode(',',$array),'type','type'=>'float');
					break;
				case 'boolean':
					$rules[]=array(implode(',',$array),$key);
					break;
				default:
					break;
				
			}
			
		} 
		return $rules;
	}

	/**
	 * @return array relational rules.
	 */
	public function relations() {
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array();
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	
	public function attributeLabels() {
		$fields=Fields::model()->findAllByAttributes(array('modelName'=>'Contacts'));
		$arr=array();
		foreach($fields as $field){
			$arr[$field->fieldName]=Yii::t('contacts',$field->attributeLabel);
		}
		
		return $arr;
	}
        public static function getNames() {
		$contactArray = Contacts::model()->findAll($condition='assignedTo=\''.Yii::app()->user->getName().'\' OR assignedTo=\'Anyone\'');
		$names=array(0=>'None');
		foreach($contactArray as $user){
			$first = $user->firstName;
			$last = $user->lastName;
			$name = $first . ' ' . $last;
			$names[$user->id]=$name;
		}
		return $names;
	}
	
	// creates virtual "name" attribute
	public function getName() {
		return $this->firstName.' '.$this->lastName;
	}
        
        public function setName($name){
            $name=trim($name);
            $this->name=$name;
            
        }
	
	public function behaviors() {
		return array(
			'ERememberFiltersBehavior' => array(
				'class' => 'application.components.ERememberFiltersBehavior',
				'defaults'=>array(),		/* optional line */
				'defaultStickOnClear'=>false	/* optional line */
			),
		);
	}

	/**
	*	Returns all public contacts.
	*	@return $names An array of strings containing the names of contacts.
	*/
	public static function getAllNames() {
		$contactArray = Contacts::model()->findAll($condition='visibility=1');
		$names=array(0=>'None');
		foreach($contactArray as $user){
			$first = $user->firstName;
			$last = $user->lastName;
			$name = $first . ' ' . $last;
			$names[$user->id]=$name;
		}
		return $names;
	}

	public static function getContactLinks($contacts) {
		if(!is_array($contacts))
			$contacts = explode(' ',$contacts);
		
		$links = array();
		foreach($contacts as &$id){
			if($id !=0 ) {
				$model = CActiveRecord::model('Contacts')->findByPk($id);
				$links[] = CHtml::link($model->name,array('contacts/view','id'=>$id));
				//$links.=$link.', ';
				
			}
		}
		//$links=substr($links,0,strlen($links)-2);
		return implode(', ',$links);
	}
	
	public static function getMailingList($criteria) {
		
		$mailingList=array();
		
		$arr=Contacts::model()->findAll();
		foreach($arr as $contact){
			$i=preg_match("/$criteria/i",$contact->backgroundInfo);
			if($i>=1){
				$mailingList[]=$contact->email;
			}
		}
		return $mailingList;
	}
	
	public function searchAll() {
		$criteria=new CDbCriteria;
		$condition = 'visibility="1" OR assignedTo="Anyone" OR assignedTo="'.Yii::app()->user->getName().'"';
		$parameters = array('limit'=>ceil(ProfileChild::getResultsPerPage()));
		/* x2temp */
		$groupLinks = Yii::app()->db->createCommand()->select('groupId')->from('x2_group_to_user')->where('userId='.Yii::app()->user->getId())->queryColumn();
		if(!empty($groupLinks))
			$condition .= ' OR assignedTo IN ('.implode(',',$groupLinks).')';
		
		
		// $groupLinks=GroupToUser::model()->findAllByAttributes(array('userId'=>Yii::app()->user->getId()));
		// $tempArray=array();
		// $temp="(";
		// foreach($groupLinks as $link){
			// $temp.=$link->groupId.", ";
			// $tempArray[]=$link->groupId;
		// }
		// $temp=substr($temp,0,-2).")";
		// if(count($temp)>2){
			// $str.=" OR assignedTo IN ".$temp;
		// }
		// foreach($tempArray as $groupId){
			// $links=GroupToUser::model()->findAllByAttributes(array('groupId'=>$groupId));
			// foreach($links as $link){
				// $userId=$link->userId;
			// }
		// }
		$condition .= 'OR (visibility=2 AND assignedTo IN 
			(SELECT username FROM x2_group_to_user WHERE groupId IN
				(SELECT groupId FROM x2_group_to_user WHERE userId='.Yii::app()->user->getId().')))';
		/* end x2temp */
		$parameters['condition']=$condition;
		$criteria->scopes=array('findAll'=>array($parameters));
				
		if(isset($_GET['tagField']) && !empty($_GET['tagField'])) {
			
			$tags = explode(',',preg_replace('/\s?,\s?/',',',trim($_GET['tagField'])));	//remove any spaces around commas, then explode to array
			
			// $str = '';
			for($i=0; $i<count($tags); $i++) {
				// $str .= ' '.$i;
				// if(empty($tags[$i])) {
					// unset($tags[$i]);
					// $i--;
					// continue;
				// } else {
					if($tags[$i][0] != '#')
						$tags[$i] = '#'.$tags[$i];
					// $tagConditions .= 'OR x2_tags.tag'
					$tags[$i] = 'x2_tags.tag = "'.$tags[$i].'"';
				// }
			}
			// die($str);
			$tagConditions = implode(' OR ',$tags);
			
			$criteria->distinct = true;
			$criteria->join = 'RIGHT JOIN x2_tags ON (x2_tags.itemId=t.id AND x2_tags.type="Contacts" AND ('.$tagConditions.'))';
		}
		return $this->searchBase($criteria);
	}

	public function search() {
		$criteria=new CDbCriteria;
		$condition = 'assignedTo="'.Yii::app()->user->getName().'"';
			$parameters=array('limit'=>ceil(ProfileChild::getResultsPerPage()));
			/* x2temp */
			$groupLinks = Yii::app()->db->createCommand()->select('groupId')->from('x2_group_to_user')->where('userId='.Yii::app()->user->getId())->queryColumn();
			if(!empty($groupLinks))
				$condition .= ' OR assignedTo IN ('.implode(',',$groupLinks).')';
			
			// $groupLinks=GroupToUser::model()->findAllByAttributes(array('userId'=>Yii::app()->user->getId()));
			// $temp="(";
			// foreach($groupLinks as $link){
				// $temp.=$link->groupId.", ";
			// }
			// $temp=substr($temp,0,-2).")";
			// $condition.=" || assignedTo IN ".$temp;
			
			/* end x2temp */
		$parameters['condition']=$condition;
		$criteria->scopes=array('findAll'=>array($parameters));
		
		return $this->searchBase($criteria);
	}
	
	public function searchAdmin() {
		$criteria=new CDbCriteria;

		return $this->searchBase($criteria);
	}

	public function searchList($id) {
	
		if(!empty($id))
			$list = CActiveRecord::model('ContactList')->findByPk($id);

		if(isset($list)) {
			// $contactIds = Yii::app()->db->createCommand()->select('contactId')->from('x2_list_items')->where('x2_list_items.listId='.$id)->queryColumn();
			// die(var_dump($contactIds));
			// $search = CActiveRecord::model('Contacts')->findAllByPk($contactIds);
			// return $search;
			
			// $sql = Yii::app()->db->createCommand()
				// ->select('x2_contacts.*')
				// ->from('x2_contacts')
				// ->join('x2_list_items','x2_contacts.id = x2_list_items.contactId')
				// ->where('x2_list_items.listId='.$id.' AND (x2_contacts.visibility=1 OR x2_contacts.assignedTo="'.Yii::app()->user->getName().'")')
				// ->getText();
			
			// $count = Yii::app()->db->createCommand()->select('COUNT(*)')->from('x2_list_items')->where('x2_list_items.listId='.$id)->queryScalar();

			$criteria = new CDbCriteria(array(
				'join'=>'LEFT JOIN x2_list_items ON t.id = x2_list_items.contactId',
				'condition'=>'x2_list_items.listId='.$id.' AND (t.visibility=1 OR t.assignedTo="'.Yii::app()->user->getName().'")',
			
			));
				
			$criteria->compare('firstName',$this->firstName,true);
			$criteria->compare('lastName',$this->lastName,true);
			$criteria->compare('title',$this->title,true);
			$criteria->compare('company',$this->company,true);
			$criteria->compare('phone',$this->phone,true);
			$criteria->compare('phone2',$this->phone2,true);
			$criteria->compare('email',$this->email,true);
			$criteria->compare('website',$this->website,true);
			$criteria->compare('address',$this->address,true);
			$criteria->compare('city',$this->city,true);
			$criteria->compare('state',$this->state,true);
			$criteria->compare('zipcode',$this->zipcode,true);
			$criteria->compare('country',$this->country,true);
			$criteria->compare('visibility',$this->visibility);
			$criteria->compare('assignedTo',$this->assignedTo,true);
			$criteria->compare('backgroundInfo',$this->backgroundInfo,true);
			$criteria->compare('twitter',$this->twitter,true);
			$criteria->compare('linkedin',$this->linkedin,true);
			$criteria->compare('skype',$this->skype,true);
			$criteria->compare('googleplus',$this->googleplus,true);
			// $criteria->compare('lastUpdated',$this->lastUpdated,true);
			$criteria->compare('updatedBy',$this->updatedBy,true);
			$criteria->compare('priority',$this->priority,true);
			$criteria->compare('leadSource',$this->leadSource,true);
			$criteria->compare('rating',$this->rating);
			// return $this->searchBase($criteria);
			echo  var_dump($this->attributes);
			return new CActiveDataProvider('Contacts',array(
				'criteria'=>$criteria,
				// 'data'=>$results,
				// 'modelClass'=>'Contacts',
				// 'totalItemCount'=>$count,
				'sort'=>array(
					'defaultOrder'=>'lastUpdated DESC',
				),
				'pagination'=>array(
					'pageSize'=>ProfileChild::getResultsPerPage(),
				),
			));
			
			
			
			
			
		/* 	return new CSqlDataProvider($sql,array(
				// 'criteria'=>$criteria,
				// 'data'=>$results,
				// 'modelClass'=>'Contacts',
				'totalItemCount'=>$count,
				'sort'=>array(
					'attributes'=>array('firstName','lastName','phone','phone2','createDate','lastUpdated','leadSource'),
					'defaultOrder'=>'lastUpdated DESC',
				),
				'pagination'=>array(
					'pageSize'=>ProfileChild::getResultsPerPage(),
				),
			)); */
		} else {
			return new CActiveDataProvider('Contacts',array(
				// 'criteria'=>$criteria,
				// 'data'=>$results,
				// 'modelClass'=>'Contacts',
				// 'totalItemCount'=>$count,
				'sort'=>array(
					'defaultOrder'=>'lastUpdated DESC',
				),
				'pagination'=>array(
					'pageSize'=>ProfileChild::getResultsPerPage(),
				),
			));
			// Yii::app()->controller->redirect(array('contacts/listAll'));
		}
		

		// $criteria=new CDbCriteria;
		// $parameters=array(
			
			// 'condition'=>"(SELECT count(*) FROM x2_list_items WHERE listId=".$id." AND contactId = t.id) > 0 AND visibility='1' || assignedTo='Anyone' || assignedTo='".Yii::app()->user->getName()."'",
			// 'limit'=>ProfileChild::getResultsPerPage()
		// );
		// $criteria->scopes=array('findAll'=>array($parameters));
		// return $this->searchBase($criteria);
	}
	
	
	public function searchBase($criteria) {
		
                $fields=Fields::model()->findAllByAttributes(array('modelName'=>'Contacts'));
                foreach($fields as $field){
                    $fieldName=$field->fieldName;
                    switch($field->type){
                        case 'boolean':
                            $criteria->compare($field->fieldName,$this->compareBoolean($this->$fieldName), true);
                            break;
                        case 'link':
                            $criteria->compare($field->fieldName,$this->compareLookup($field, $this->$fieldName), true);
                            break;
                        case 'assignment':
                            $criteria->compare($field->fieldName,$this->compareAssignment($this->$fieldName), true);
                            break;
                        default:
                            $criteria->compare($field->fieldName,$this->$fieldName,true);
                    }
                    
                }
                
                $criteria->compare('CONCAT(firstName," ",lastName)', $this->name,true);


		return new SmartDataProvider(get_class($this), array(
			'sort'=>array(
				'defaultOrder'=>'lastUpdated DESC',
			),
			'pagination'=>array(
				'pageSize'=>ProfileChild::getResultsPerPage(),
			),
			'criteria'=>$criteria,
		));
	}
        
        private function compareLookup($field, $data){
            if(is_null($data) || $data=="") return null; 
            $type=ucfirst($field->linkType);
            if($type=='Contacts'){
                eval("\$lookupModel=$type::model()->findAllBySql('SELECT * FROM x2_$field->linkType WHERE CONCAT(firstName,\' \', lastName) LIKE \'%$data%\'');");
            }else{
                eval("\$lookupModel=$type::model()->findAllBySql('SELECT * FROM x2_$field->linkType WHERE name LIKE \'%$data%\'');");
            }
            if(isset($lookupModel) && count($lookupModel)>0){
                $arr=array();
                foreach($lookupModel as $model){
                    $arr[]=$model->id;
                }
                return $arr;
            }else
                return -1;
        }
        
        private function compareBoolean($data){
            if(is_null($data) || $data=='') return null;
            if(is_numeric($data)) return $data;
            if($data==Yii::t('actions',"Yes"))
                return 1;
            elseif($data==Yii::t('actions',"No"))
                return 0;
            else
                return -1;
        }
        
        private function compareAssignment($data){
            if(is_null($data)) return null;
            if(is_numeric($data)){
                $models=Groups::model()->findAllBySql("SELECT * FROM x2_groups WHERE name LIKE '%$data%'");
                $arr=array();
                foreach($models as $model){
                    $arr[]=$model->id;
                }
                return count($arr)>0?$arr:-1;
            }else{
                $models=UserChild::model()->findAllBySql("SELECT * FROM x2_users WHERE CONCAT(firstName,' ',lastName) LIKE '%$data%'");
                $arr=array();
                foreach($models as $model){
                    $arr[]=$model->username;
                }
                return count($arr)>0?$arr:-1;
            }
        }
        
        

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
}