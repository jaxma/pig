<?php
	/**
     * �����ļ�����
	 * ����code�ֶε�ֵ�õ�value�ֶε�ֵ
	 * ԭ����value�ֶ�Ϊ�����ȼ���code�ֶε�ֵ
     * @param $code code�ֶε�ֵ
     * @author jax <1105190775@qq.com>
     * @example
     * ---------------------------------------------------------
     * $address=getSel('address');
     * ---------------------------------------------------------
     */
		function getSel($code){
		$con = M('config');
		$con = $con->select();
		$config = array();
		foreach($con as $value){
			$config[$value['code']]=$value;
		}
		$con = $config[$code]['value'];
		return $con;
	}
	
	/**
     * ��ѯһ����¼��ĳ�ֶε�ֵ
     * @param $tableName ������ǰ׺���ú�ɲ���ǰ׺
	 * $id ����
     * $con �ֶ�����
     * @author jax <1105190775@qq.com>
     * @example
     * ---------------------------------------------------------
     * $doc=getOne('document',1,'content');
     * ---------------------------------------------------------
     */
		function getOne($tableName,$id,$con){
			$doc = M($tableName);
			$doc = $doc->where("id={$id}")->select();
			foreach($doc as $k=>$v){
				$doc=$v;
			}
			return $doc=$doc[$con];
		}
?>