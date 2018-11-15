<?php
	/**
     * 配置文件函数
	 * 根据code字段的值得到value字段的值
	 * 原理：以value字段为键，等价于code字段的值
     * @param $code code字段的值
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
     * 查询一条记录中某字段的值
     * @param $tableName 表名，前缀设置后可不带前缀
	 * $id 条件
     * $con 字段名称
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