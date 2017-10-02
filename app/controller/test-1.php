<?php 

Class test extends base_module
{
	public function __construct(&$_app)
	{
		$_app->module_name = __CLASS__;
		parent::__construct($_app);

		$this->_app->navigation->set_breadcrumb("Zone de test");




		$req_sql_general = array('table' => 'appart_ft_product',
								  "datas" => array("id","image","name","code",
																array("table" => "appart_ft_product_caract",
																	"join_on" => array("id_product", "id"),
																	"as" => 'attributes_product',
																	"datas" => array("diameter",
																						array("table" => "appart_ft_product_attribut", 
																						"join_on" => array("id_product", "id"),
																						 "as" => 'attributes_product_test',
																						"datas" => array("attribute",
																													array("table" => "appart_ft_product_attribut", 
																												"join_on" => array("id_product", "id"),
																												 "as" => 'attributes_product_test_test',
																												"datas" => array("attribute",
																																			array("table" => "appart_ft_product_attribut", 
																																		"join_on" => array("id_product", "id"),
																																		 "as" => 'attributes_product_test_test',
																																		"datas" => array("attribute")
																																				)
																																	)
																														)
																										)
																						  )
																				)
																	)
										),
						'where' => "appart_ft_product.id",
						'where_array' => [1,2,3,4,5,6]
						);


		$req_principale = array();
		$req_two = array();

		

		if(isset($req_sql_general['where_array']) && is_array($req_sql_general['where_array']))
		{
			$i = 0;
			$var_for_select_niveau_1 = array();

			foreach($req_sql_general['where_array'] as $row_where_array)
			{
				$req_select_niveau_1[$i] = "SELECT ";

				foreach($req_sql_general['datas'] as $row_datas_level_1)
				{
					if(!is_array($row_datas_level_1))
					{
						if(!isset($var_for_select_niveau_1[$i]))
							$var_for_select_niveau_1[$i] = "";

						$var_for_select_niveau_1[$i] .= $row_datas_level_1.",";
					}
					else
					{
						// on descned d'un niveau

						$var_for_select_niveau_2 = "";
						$add_var_for_descending_level_2 = $row_datas_level_1['as'];
						foreach($row_datas_level_1['datas'] as $row_datas_level_2)
						{
							if(is_array($row_datas_level_2))
							{
								$is_array = true;
								$datas_level_3 = $row_datas_level_2;
							}
							else
							{
								$var_for_select_niveau_2 .= $row_datas_level_2." ,";
							}
						}
						$var_for_select_niveau_2 = substr($var_for_select_niveau_2, 0, -1);


						if(isset($is_array))
						{
							unset($is_array);
								//descnte d'un niveau de profondeur
							$add_var_for_descending_level_3 = $datas_level_3['as'];
							foreach($datas_level_3 as $row_data_3)
							{

								if(is_array($row_data_3))
								{
									$var_for_select_niveau_3 = "";

									foreach($row_data_3 as $row_datas_level_3)
									{
										if(is_array($row_datas_level_3))
										{
											$is_array = true;
											$datas_level_4 = $row_datas_level_3;
										}
										else
										{
											$var_for_select_niveau_3 .= $row_datas_level_3." ,";
										}
									}
									$var_for_select_niveau_3 = substr($var_for_select_niveau_3, 0, -1);
									if(isset($is_array))
									{
										unset($is_array);
										//descnte d'un niveau de profondeur
										$add_var_for_descending_level_4 = $datas_level_4['as'];
										foreach($datas_level_4 as $row_data_4)
										{

											if(is_array($row_data_4))
											{
												$var_for_select_niveau_4 = "";

												foreach($row_data_4 as $row_datas_level_4)
												{
													if(is_array($row_datas_level_4))
													{
														$is_array = true;
														$datas_level_5 = $row_datas_level_4;
													}
													else
													{
														$var_for_select_niveau_4 .= $row_datas_level_4." ,";
													}
												}
												$var_for_select_niveau_4 = substr($var_for_select_niveau_4, 0, -1);
												if(isset($is_array))
												{
													unset($is_array);
													//descnte d'un niveau de profondeur

													$add_var_for_descending_level_5 = $datas_level_5['as'];
													foreach($datas_level_5 as $row_data_5)
													{
														if(is_array($row_data_5))
														{
															$var_for_select_niveau_5 = "";

															foreach($row_data_5 as $row_datas_level_5)
															{
																if(is_array($row_datas_level_5))
																{
																	$is_array = true;
																	$datas_level_6 = $row_datas_level_5;
																}
																else
																{
																	$var_for_select_niveau_5 .= $row_datas_level_5." ,";
																}
															}
															$var_for_select_niveau_5 = substr($var_for_select_niveau_5, 0, -1);
															if(isset($is_array))
															{
																//on détecte un niveau inférieur de requete
															}
															$req_five[(int)$row_where_array] = "SELECT ".$var_for_select_niveau_5."
															FROM ".$datas_level_5['table']." 
															LEFT JOIN ".$req_sql_general['table']." 
															ON ".$datas_level_5['table'].".".$datas_level_5['join_on'][0]." = ".$req_sql_general['table'].".".$datas_level_5['join_on'][1]." 
															WHERE ".$req_sql_general['where']." = ".(int)$row_where_array;

														}
														
													}
													//on détecte un niveau inférieur de requete*/
												}
												$req_four[(int)$row_where_array] = "SELECT ".$var_for_select_niveau_4."
												FROM ".$datas_level_4['table']." 
												LEFT JOIN ".$req_sql_general['table']." 
												ON ".$datas_level_4['table'].".".$datas_level_4['join_on'][0]." = ".$req_sql_general['table'].".".$datas_level_4['join_on'][1]." 
												WHERE ".$req_sql_general['where']." = ".(int)$row_where_array;

											}
											
										}
										//on détecte un niveau inférieur de requete*/
									}
									$req_three[(int)$row_where_array] = "SELECT ".$var_for_select_niveau_3."
									FROM ".$datas_level_3['table']." 
									LEFT JOIN ".$req_sql_general['table']." 
									ON ".$datas_level_3['table'].".".$datas_level_3['join_on'][0]." = ".$req_sql_general['table'].".".$datas_level_3['join_on'][1]." 
									WHERE ".$req_sql_general['where']." = ".(int)$row_where_array;

								}
								
							}
						}

						
						$req_two[(int)$row_where_array] = "SELECT ".$var_for_select_niveau_2." 
						FROM ".$row_datas_level_1['table']." 
						LEFT JOIN ".$req_sql_general['table']." 
						ON ".$row_datas_level_1['table'].".".$row_datas_level_1['join_on'][0]." = ".$req_sql_general['table'].".".$row_datas_level_1['join_on'][1]."
						WHERE ".$req_sql_general['where']." = ".(int)$row_where_array;
						

					}
					
				}
				//execution des requete de level 1 
				$req_principale[$i] = "SELECT ".substr($var_for_select_niveau_1[$i] , 0, -1);
				$req_principale[$i] .= " FROM ".$req_sql_general['table']." WHERE ".$req_sql_general['where']." = ".$row_where_array;
				$tmp = $this->sql->other_query($req_principale[$i]);
				$req_principale[$i] = $tmp[0];
				$i++;
			}
			

//on execute les requete de couche 5
			if(isset($req_five))
			{
				$fx_couche_5 = array();
				foreach($req_five as $row_sql)
				{
					$res_req_five = $this->sql->other_query($row_sql);
					$fx_couche_5[] = $res_req_five;
				}
			}


//on execute les requete de couche 4
			if(isset($req_four))
			{
				$fx_couche_4 = array();
				foreach($req_four as $row_sql)
				{
					$res_req_four = $this->sql->other_query($row_sql);
					$fx_couche_4[] = $res_req_four;
				}
			}

//on execute les requete de couche 3
			if(isset($req_three))
			{
				$fx_couche_3 = array();
				foreach($req_three as $row_sql)
				{
					$res_req_three = $this->sql->other_query($row_sql);
					$fx_couche_3[] = $res_req_three;
				}
			}

			//on execute les requete de couche 2
			if(isset($req_two))
			{
				$fx_couche_2 = array();
				foreach($req_two as $row_sql)
				{
					$res_req_two = $this->sql->other_query($row_sql);
					$fx_couche_2[] = $res_req_two;
				}
			}



			//on assemble les execution

			$count_level_1 = count($req_principale);
			$tmp_level_1 = array();

			$i = 0;
			while($i < $count_level_1)
			{
				$tmp_level_1[$i] = (array)$req_principale[$i];
				
				if(isset($fx_couche_3))
				{
					foreach($fx_couche_2 as $key_couche_2 => $row_couche_2)
					{
						foreach($row_couche_2 as $key_couche_3 => $row_couche_3)
						{
							(array)$fx_couche_2[$key_couche_2][$key_couche_3]->$add_var_for_descending_level_3 = (array)$fx_couche_3[$key_couche_2];
							if(isset($fx_couche_4))
							{
								foreach($fx_couche_2[$key_couche_2][$key_couche_3]->$add_var_for_descending_level_3 as $row_test)
								{
									$row_test->$add_var_for_descending_level_4 = (array)$fx_couche_4[$key_couche_2];
									if(isset($fx_couche_5))
									{
										foreach($row_test->$add_var_for_descending_level_4 as $row_test_5)
										{
											$row_test_5->$add_var_for_descending_level_5 = (array)$fx_couche_5[$key_couche_2];
										}
									}
								}
							}
						}
					}
				}

				if(isset($fx_couche_2))
				{
					$tmp_level_1[$i][$add_var_for_descending_level_2] = (array)$fx_couche_2[$i];

				}
				$i ++;
			}
		}
		else
		{
			throw new Exception('Where clause is not an array, Or is not isset');
		}
		


		affiche_pre($tmp_level_1);



		$this->get_html_tpl = $this->render_tpl();
	}		

	public function gestion_couche()
	{
		//descnte d'un niveau de profondeur
		$add_var_for_descending_level_5 = $datas_level_5['as'];
		foreach($datas_level_5 as $row_data_5)
		{

			if(is_array($row_data_5))
			{
				$var_for_select_niveau_5 = "";

				foreach($row_data_5 as $row_datas_level_5)
				{
					if(is_array($row_datas_level_5))
					{
						$is_array = true;
						$datas_level_6 = $row_datas_level_5;
					}
					else
					{
						$var_for_select_niveau_5 .= $row_datas_level_5." ,";
					}
				}
				$var_for_select_niveau_5 = substr($var_for_select_niveau_5, 0, -1);
				if(isset($is_array))
				{
					//on détecte un niveau inférieur de requete
				}
				$req_five[(int)$row_where_array] = "SELECT ".$var_for_select_niveau_5."
				FROM ".$datas_level_5['table']." 
				LEFT JOIN ".$req_sql_general['table']." 
				ON ".$datas_level_5['table'].".".$datas_level_5['join_on'][0]." = ".$req_sql_general['table'].".".$datas_level_5['join_on'][1]." 
				WHERE ".$req_sql_general['where']." = ".(int)$row_where_array;

			}
			
		}
		//on détecte un niveau inférieur de requete*/
	}
}


	