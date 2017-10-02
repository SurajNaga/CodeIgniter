<?php
require_once 'Mage/Checkout/controllers/OnepageController.php';
class Alm_Checkout_OnepageController extends Mage_Checkout_OnepageController
{
	public function indexAction()
	{
		 
	 $flag = Mage::getModel('alm_checkout/checkout')->validateFlag(); 
		
		switch ($flag){
			case 1:
				
				$this->_redirect('checkout/onepage/shippingprocess');
				break;
			case 2:
				return parent::indexAction();
					
		}
		
	}
		public function shippingprocessAction(){
			$cart = Mage::getModel('checkout/cart')->getQuote();
			$code=array();
			foreach ($cart->getAllItems() as $item) {
				$productName = $item->getProduct()->getName();
				$productPrice = $item->getProduct()->getPrice();
				$productid=$item->getProduct()->getID();
				$productsku=$item->getProduct()->getSku();
				
				$product=Mage::getModel('catalog/product')->loadByAttribute('sku',$productsku);
				$countries=$product->getAttributeText('available_countries');
				
				  foreach($countries as $values)
				  
				  {
					
					$countrycodes = array (
					  'AF' => 'Afghanistan',
					  'AX' => 'Åland Islands',
					  'AL' => 'Albania',
					  'DZ' => 'Algeria',
					  'AS' => 'American Samoa',
					  'AD' => 'Andorra',
					  'AO' => 'Angola',
					  'AI' => 'Anguilla',
					  'AQ' => 'Antarctica',
					  'AG' => 'Antigua and Barbuda',
					  'AR' => 'Argentina',
					  'AU' => 'Australia',
					  'AT' => 'Austria',
					  'AZ' => 'Azerbaijan',
					  'BS' => 'Bahamas',
					  'BH' => 'Bahrain',
					  'BD' => 'Bangladesh',
					  'BB' => 'Barbados',
					  'BY' => 'Belarus',
					  'BE' => 'Belgium',
					  'BZ' => 'Belize',
					  'BJ' => 'Benin',
					  'BM' => 'Bermuda',
					  'BT' => 'Bhutan',
					  'BO' => 'Bolivia',
					  'BA' => 'Bosnia and Herzegovina',
					  'BW' => 'Botswana',
					  'BV' => 'Bouvet Island',
					  'BR' => 'Brazil',
					  'IO' => 'British Indian Ocean Territory',
					  'BN' => 'Brunei Darussalam',
					  'BG' => 'Bulgaria',
					  'BF' => 'Burkina Faso',
					  'BI' => 'Burundi',
					  'KH' => 'Cambodia',
					  'CM' => 'Cameroon',
					  'CA' => 'Canada',
					  'CV' => 'Cape Verde',
					  'KY' => 'Cayman Islands',
					  'CF' => 'Central African Republic',
					  'TD' => 'Chad',
					  'CL' => 'Chile',
					  'CN' => 'China',
					  'CX' => 'Christmas Island',
					  'CC' => 'Cocos (Keeling) Islands',
					  'CO' => 'Colombia',
					  'KM' => 'Comoros',
					  'CG' => 'Congo',
					  'CD' => 'Zaire',
					  'CK' => 'Cook Islands',
					  'CR' => 'Costa Rica',
					  'CI' => 'Côte D\'Ivoire',
					  'HR' => 'Croatia',
					  'CU' => 'Cuba',
					  'CY' => 'Cyprus',
					  'CZ' => 'Czech Republic',
					  'DK' => 'Denmark',
					  'DJ' => 'Djibouti',
					  'DM' => 'Dominica',
					  'DO' => 'Dominican Republic',
					  'EC' => 'Ecuador',
					  'EG' => 'Egypt',
					  'SV' => 'El Salvador',
					  'GQ' => 'Equatorial Guinea',
					  'ER' => 'Eritrea',
					  'EE' => 'Estonia',
					  'ET' => 'Ethiopia',
					  'FK' => 'Falkland Islands (Malvinas)',
					  'FO' => 'Faroe Islands',
					  'FJ' => 'Fiji',
					  'FI' => 'Finland',
					  'FR' => 'France',
					  'GF' => 'French Guiana',
					  'PF' => 'French Polynesia',
					  'TF' => 'French Southern Territories',
					  'GA' => 'Gabon',
					  'GM' => 'Gambia',
					  'GE' => 'Georgia',
					  'DE' => 'Germany',
					  'GH' => 'Ghana',
					  'GI' => 'Gibraltar',
					  'GR' => 'Greece',
					  'GL' => 'Greenland',
					  'GD' => 'Grenada',
					  'GP' => 'Guadeloupe',
					  'GU' => 'Guam',
					  'GT' => 'Guatemala',
					  'GG' => 'Guernsey',
					  'GN' => 'Guinea',
					  'GW' => 'Guinea-Bissau',
					  'GY' => 'Guyana',
					  'HT' => 'Haiti',
					  'HM' => 'Heard Island and Mcdonald Islands',
					  'VA' => 'Vatican City State',
					  'HN' => 'Honduras',
					  'HK' => 'Hong Kong',
					  'HU' => 'Hungary',
					  'IS' => 'Iceland',
					  'IN' => 'India',
					  'ID' => 'Indonesia',
					  'IR' => 'Iran, Islamic Republic of',
					  'IQ' => 'Iraq',
					  'IE' => 'Ireland',
					  'IM' => 'Isle of Man',
					  'IL' => 'Israel',
					  'IT' => 'Italy',
					  'JM' => 'Jamaica',
					  'JP' => 'Japan',
					  'JE' => 'Jersey',
					  'JO' => 'Jordan',
					  'KZ' => 'Kazakhstan',
					  'KE' => 'KENYA',
					  'KI' => 'Kiribati',
					  'KP' => 'Korea, Democratic People\'s Republic of',
					  'KR' => 'Korea, Republic of',
					  'KW' => 'Kuwait',
					  'KG' => 'Kyrgyzstan',
					  'LA' => 'Lao People\'s Democratic Republic',
					  'LV' => 'Latvia',
					  'LB' => 'Lebanon',
					  'LS' => 'Lesotho',
					  'LR' => 'Liberia',
					  'LY' => 'Libyan Arab Jamahiriya',
					  'LI' => 'Liechtenstein',
					  'LT' => 'Lithuania',
					  'LU' => 'Luxembourg',
					  'MO' => 'Macao',
					  'MK' => 'Macedonia, the Former Yugoslav Republic of',
					  'MG' => 'Madagascar',
					  'MW' => 'Malawi',
					  'MY' => 'Malaysia',
					  'MV' => 'Maldives',
					  'ML' => 'Mali',
					  'MT' => 'Malta',
					  'MH' => 'Marshall Islands',
					  'MQ' => 'Martinique',
					  'MR' => 'Mauritania',
					  'MU' => 'Mauritius',
					  'YT' => 'Mayotte',
					  'MX' => 'Mexico',
					  'FM' => 'Micronesia, Federated States of',
					  'MD' => 'Moldova, Republic of',
					  'MC' => 'Monaco',
					  'MN' => 'Mongolia',
					  'ME' => 'Montenegro',
					  'MS' => 'Montserrat',
					  'MA' => 'Morocco',
					  'MZ' => 'Mozambique',
					  'MM' => 'Myanmar',
					  'NA' => 'Namibia',
					  'NR' => 'Nauru',
					  'NP' => 'Nepal',
					  'NL' => 'Netherlands',
					  'AN' => 'Netherlands Antilles',
					  'NC' => 'New Caledonia',
					  'NZ' => 'New Zealand',
					  'NI' => 'Nicaragua',
					  'NE' => 'Niger',
					  'NG' => 'Nigeria',
					  'NU' => 'Niue',
					  'NF' => 'Norfolk Island',
					  'MP' => 'Northern Mariana Islands',
					  'NO' => 'Norway',
					  'OM' => 'Oman',
					  'PK' => 'Pakistan',
					  'PW' => 'Palau',
					  'PS' => 'Palestinian Territory, Occupied',
					  'PA' => 'Panama',
					  'PG' => 'Papua New Guinea',
					  'PY' => 'Paraguay',
					  'PE' => 'Peru',
					  'PH' => 'Philippines',
					  'PN' => 'Pitcairn',
					  'PL' => 'Poland',
					  'PT' => 'Portugal',
					  'PR' => 'Puerto Rico',
					  'QA' => 'Qatar',
					  'RE' => 'Réunion',
					  'RO' => 'Romania',
					  'RU' => 'Russian Federation',
					  'RW' => 'Rwanda',
					  'SH' => 'Saint Helena',
					  'KN' => 'Saint Kitts and Nevis',
					  'LC' => 'Saint Lucia',
					  'PM' => 'Saint Pierre and Miquelon',
					  'VC' => 'Saint Vincent and the Grenadines',
					  'WS' => 'Samoa',
					  'SM' => 'San Marino',
					  'ST' => 'Sao Tome and Principe',
					  'SA' => 'Saudi Arabia',
					  'SN' => 'Senegal',
					  'RS' => 'Serbia',
					  'SC' => 'Seychelles',
					  'SL' => 'Sierra Leone',
					  'SG' => 'Singapore',
					  'SK' => 'Slovakia',
					  'SI' => 'Slovenia',
					  'SB' => 'Solomon Islands',
					  'SO' => 'Somalia',
					  'ZA' => 'South Africa',
					  'GS' => 'South Georgia and the South Sandwich Islands',
					  'ES' => 'Spain',
					  'LK' => 'Sri Lanka',
					  'SD' => 'Sudan',
					  'SR' => 'Suriname',
					  'SJ' => 'Svalbard and Jan Mayen',
					  'SZ' => 'Swaziland',
					  'SE' => 'Sweden',
					  'CH' => 'Switzerland',
					  'SY' => 'Syrian Arab Republic',
					  'TW' => 'Taiwan, Province of China',
					  'TJ' => 'Tajikistan',
					  'TZ' => 'Tanzania, United Republic of',
					  'TH' => 'Thailand',
					  'TL' => 'Timor-Leste',
					  'TG' => 'Togo',
					  'TK' => 'Tokelau',
					  'TO' => 'Tonga',
					  'TT' => 'Trinidad and Tobago',
					  'TN' => 'Tunisia',
					  'TR' => 'Turkey',
					  'TM' => 'Turkmenistan',
					  'TC' => 'Turks and Caicos Islands',
					  'TV' => 'Tuvalu',
					  'UG' => 'Uganda',
					  'UA' => 'Ukraine',
					  'AE' => 'United Arab Emirates',
					  'GB' => 'United Kingdom',
					  'US' => 'United States',
					  'UM' => 'United States Minor Outlying Islands',
					  'UY' => 'Uruguay',
					  'UZ' => 'Uzbekistan',
					  'VU' => 'Vanuatu',
					  'VE' => 'Venezuela',
					  'VN' => 'Viet Nam',
					  'VG' => 'Virgin Islands, British',
					  'VI' => 'Virgin Islands, U.S.',
					  'WF' => 'Wallis and Futuna',
					  'EH' => 'Western Sahara',
					  'YE' => 'Yemen',
					  'ZM' => 'Zambia',
					  'ZW' => 'Zimbabwe',
					);
				$code[] =array_search($values, $countrycodes);
				//echo $code."<br/>";
				//echo count($code);
				 }
				 
				//echo "code".$code."<br/>";
				$geoIP = Mage::getSingleton('geoip/country');
				$country= $geoIP->getCountry();
				if(in_array($country,$code))
				{
					Mage::getModel('alm_checkout/checkout')->shipmentbefore();
					Mage::getModel('alm_checkout/checkout')->ordership();
					$this->loadLayout();
					$this->renderLayout();
				}
				else
				{
					$this->loadLayout();
					$availability='No';
					Mage::register('data', $availability);
					
					
					//$object->setData('availability',$availability);
					$this->renderLayout();
					
				}
				
				
			}
			
			
			
		}
		
		public function saveBillingAction()
		{
			if ($this->_expireAjax()) {
				return;
			}
			if ($this->getRequest()->isPost()) {
				//            $postData = $this->getRequest()->getPost('billing', array());
				//            $data = $this->_filterPostData($postData);
				$data = $this->getRequest()->getPost('billing', array());
				$customerAddressId = $this->getRequest()->getPost('billing_address_id', false);
		
				if (isset($data['email'])) {
					$data['email'] = trim($data['email']);
				}
				$result = $this->getOnepage()->saveBilling($data, $customerAddressId);
		
				if (!isset($result['error'])) {
					/* check quote for virtual */
					if ($this->getOnepage()->getQuote()->isVirtual()) {
						$result['goto_section'] = 'payment';
						$result['update_section'] = array(
								'name' => 'payment-method',
								'html' => $this->_getPaymentMethodsHtml()
						);
					} elseif (isset($data['use_for_shipping']) && $data['use_for_shipping'] == 1) {
						$result['goto_section'] = 'payment';
						$result['update_section'] = array(
								'name' => 'payment-method',
								'html' => $this->_getPaymentMethodsHtml()
						);
		
						$result['allow_sections'] = array('shipping');
						$result['duplicateBillingInfo'] = 'true';
					} else {
						$result['goto_section'] = 'shipping';
					}
				}
		
				$this->getResponse()->setBody(Mage::helper('core')->jsonEncode($result));
			}
		}
		
		public function saveShippingAction()
		{
			if ($this->_expireAjax()) {
				return;
			}
			if ($this->getRequest()->isPost()) {
				$data = $this->getRequest()->getPost('shipping', array());
				$customerAddressId = $this->getRequest()->getPost('shipping_address_id', false);
				$result = $this->getOnepage()->saveShipping($data, $customerAddressId);
		
				if (!isset($result['error'])) {
					$result['goto_section'] = 'payment';
					$result['update_section'] = array(
							'name' => 'payment-method',
							'html' => $this->_getPaymentMethodsHtml()
					);
				}
				$this->getResponse()->setBody(Mage::helper('core')->jsonEncode($result));
			}
		}
		
		
	
	
}