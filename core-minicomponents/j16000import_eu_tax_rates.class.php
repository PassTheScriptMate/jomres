<?php
/**
 * Core file
 *
 * @author Vince Wooll <sales@jomres.net>
 * @version Jomres 7
 * @package Jomres
 * @copyright    2005-2013 Vince Wooll
 * Jomres (tm) PHP, CSS & Javascript files are released under both MIT and GPL2 licenses. This means that you can choose the license that best suits your project, and use it accordingly.
 **/


// ################################################################
defined( '_JOMRES_INITCHECK' ) or die( '' );
// ################################################################

class j16000import_eu_tax_rates
	{
	function j16000import_eu_tax_rates()
		{
		// Must be in all minicomponents. Minicomponents with templates that can contain editable text should run $this->template_touch() else just return
		$MiniComponents = jomres_singleton_abstract::getInstance( 'mcHandler' );
		if ( $MiniComponents->template_touch )
			{
			$this->template_touchable = false;

			return;
			}
		
		jr_import("jrportal_taxrate");
		$tax_rates_class = new jrportal_taxrate();
		$result = $tax_rates_class->deleteAllTaxRates();
		if ($result)
			{
			// http://en.wikipedia.org/wiki/European_Union_value_added_tax#EU_VAT_area
			
			$new_tax_rates = array();
			$new_tax_rates[] = array( "rate"=>20, "code"=>'MwSt.', "description"=>"Mehrwertsteuer (Austria)" );
			$new_tax_rates[] = array( "rate"=>21, "code"=>'BTW', "description"=>"Belasting over de toegevoegde waarde (Belgium)" );
			$new_tax_rates[] = array( "rate"=>20, "code"=>'ДДС', "description"=>"Данък върху добавената стойност  (Bulgaria)" );
			$new_tax_rates[] = array( "rate"=>18, "code"=>'ΦΠΑ', "description"=>"Φόρος Προστιθέμενης Αξίας (Cyprus)" );
			$new_tax_rates[] = array( "rate"=>21, "code"=>'DPH', "description"=>"Daň z přidané hodnoty (Czech Republic)" );
			$new_tax_rates[] = array( "rate"=>25, "code"=>'PDV', "description"=>"(Croatia)" );
			$new_tax_rates[] = array( "rate"=>25, "code"=>'moms', "description"=>"Meromsætningsafgift (Denmark)" );
			$new_tax_rates[] = array( "rate"=>20, "code"=>'km', "description"=>"käibemaks (Estonia)" );
			$new_tax_rates[] = array( "rate"=>24, "code"=>'ALV', "description"=>"Arvonlisävero (Finland)" );
			$new_tax_rates[] = array( "rate"=>0, "code"=>'ALV', "description"=>"Arvonlisävero (Finland Åland)" );
			$new_tax_rates[] = array( "rate"=>19.6, "code"=>'TVA', "description"=>"Taxe sur la valeur ajoutée (France)" );
			$new_tax_rates[] = array( "rate"=>19, "code"=>'MwSt.', "description"=>"Mehrwertsteuer (Germany)" );
			$new_tax_rates[] = array( "rate"=>23, "code"=>'ΦΠΑ', "description"=>"Φόρος Προστιθέμενης Αξίας (Greece)" );
			$new_tax_rates[] = array( "rate"=>27, "code"=>'ÁFA', "description"=>"általános forgalmi adó (Hungary)" );
			$new_tax_rates[] = array( "rate"=>23, "code"=>'VAT', "description"=>"Value Added Tax (Ireland)" );
			$new_tax_rates[] = array( "rate"=>21, "code"=>'IVA', "description"=>"Imposta sul Valore Aggiunto (Italy)" );
			$new_tax_rates[] = array( "rate"=>21, "code"=>'PVN', "description"=>"Pievienotās vērtības nodoklis (Latvia)" );
			$new_tax_rates[] = array( "rate"=>21, "code"=>'PVM', "description"=>"Pridėtinės vertės mokestis (Lithuania)" );
			$new_tax_rates[] = array( "rate"=>15, "code"=>'TVA', "description"=>"Taxe sur la Valeur Ajoutée (Luxembourg)" );
			$new_tax_rates[] = array( "rate"=>18, "code"=>'VAT', "description"=>"Taxxa fuq il-Valur Miżjud (Malta)" );
			$new_tax_rates[] = array( "rate"=>21, "code"=>'BTW', "description"=>"Belasting toegevoegde waarde (Netherlands)" );
			$new_tax_rates[] = array( "rate"=>23, "code"=>'PTU', "description"=>"Podatek od towarów i usług (Poland)" );
			$new_tax_rates[] = array( "rate"=>23, "code"=>'IVA', "description"=>"Imposto sobre o Valor Acrescentado (Portugal)" );
			$new_tax_rates[] = array( "rate"=>23, "code"=>'IVA', "description"=>"Imposto sobre o Valor Acrescentado (Madeira)" );
			$new_tax_rates[] = array( "rate"=>23, "code"=>'IV', "description"=>"A Imposto sobre o Valor Acrescentado (Azores)" );
			$new_tax_rates[] = array( "rate"=>24, "code"=>'TVA', "description"=>"Taxa pe valoarea adăugată (Romania)" );
			$new_tax_rates[] = array( "rate"=>20, "code"=>'DPH', "description"=>"Daň z pridanej hodnoty (Slovakia)" );
			$new_tax_rates[] = array( "rate"=>20, "code"=>'DDV', "description"=>"Davek na dodano vrednost (Slovenia)" );
			$new_tax_rates[] = array( "rate"=>21, "code"=>'IVA', "description"=>"Impuesto sobre el valor añadido (Spain)" );
			$new_tax_rates[] = array( "rate"=>7, "code"=>'IGIC', "description"=>"Impuesto General Indirecto Canario (Canary Islands)" );
			$new_tax_rates[] = array( "rate"=>25, "code"=>'Moms', "description"=>"Mervärdesskatt (Sweden)" );
			$new_tax_rates[] = array( "rate"=>20, "code"=>'VAT', "description"=>"Value Added Tax (United Kingdom)" );
			$new_tax_rates[] = array( "rate"=>20, "code"=>' VAT', "description"=>"Value Added Tax (Isle of Man)" );
			
			foreach ($new_tax_rates as $rate)
				{
				$tax_rates_class = new jrportal_taxrate();
				$tax_rates_class->code = $rate['code'];
				$tax_rates_class->rate = $rate['rate'];
				$tax_rates_class->description = $rate['description'];
				$tax_rates_class->commitTaxRate();
				}
			jomresRedirect( jomresURL( JOMRES_SITEPAGE_URL_ADMIN . "&task=list_taxrates"), "" );
			}
		else
			{
			echo "Error, could not TRUNACATE tax rates table for some reason";
			}
		}


	// This must be included in every Event/Mini-component
	function getRetVals()
		{
		return null;
		}
	}