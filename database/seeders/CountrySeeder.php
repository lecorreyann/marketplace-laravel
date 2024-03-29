<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    //
    $countries = array(
      array('iso_3166-1_alpha-2' => 'US', 'name' => 'United States'),
      array('iso_3166-1_alpha-2' => 'CA', 'name' => 'Canada'),
      array('iso_3166-1_alpha-2' => 'AF', 'name' => 'Afghanistan'),
      array('iso_3166-1_alpha-2' => 'AL', 'name' => 'Albania'),
      array('iso_3166-1_alpha-2' => 'DZ', 'name' => 'Algeria'),
      array('iso_3166-1_alpha-2' => 'AS', 'name' => 'American Samoa'),
      array('iso_3166-1_alpha-2' => 'AD', 'name' => 'Andorra'),
      array('iso_3166-1_alpha-2' => 'AO', 'name' => 'Angola'),
      array('iso_3166-1_alpha-2' => 'AI', 'name' => 'Anguilla'),
      array('iso_3166-1_alpha-2' => 'AQ', 'name' => 'Antarctica'),
      array('iso_3166-1_alpha-2' => 'AG', 'name' => 'Antigua and/or Barbuda'),
      array('iso_3166-1_alpha-2' => 'AR', 'name' => 'Argentina'),
      array('iso_3166-1_alpha-2' => 'AM', 'name' => 'Armenia'),
      array('iso_3166-1_alpha-2' => 'AW', 'name' => 'Aruba'),
      array('iso_3166-1_alpha-2' => 'AU', 'name' => 'Australia'),
      array('iso_3166-1_alpha-2' => 'AT', 'name' => 'Austria'),
      array('iso_3166-1_alpha-2' => 'AZ', 'name' => 'Azerbaijan'),
      array('iso_3166-1_alpha-2' => 'BS', 'name' => 'Bahamas'),
      array('iso_3166-1_alpha-2' => 'BH', 'name' => 'Bahrain'),
      array('iso_3166-1_alpha-2' => 'BD', 'name' => 'Bangladesh'),
      array('iso_3166-1_alpha-2' => 'BB', 'name' => 'Barbados'),
      array('iso_3166-1_alpha-2' => 'BY', 'name' => 'Belarus'),
      array('iso_3166-1_alpha-2' => 'BE', 'name' => 'Belgium'),
      array('iso_3166-1_alpha-2' => 'BZ', 'name' => 'Belize'),
      array('iso_3166-1_alpha-2' => 'BJ', 'name' => 'Benin'),
      array('iso_3166-1_alpha-2' => 'BM', 'name' => 'Bermuda'),
      array('iso_3166-1_alpha-2' => 'BT', 'name' => 'Bhutan'),
      array('iso_3166-1_alpha-2' => 'BO', 'name' => 'Bolivia'),
      array('iso_3166-1_alpha-2' => 'BA', 'name' => 'Bosnia and Herzegovina'),
      array('iso_3166-1_alpha-2' => 'BW', 'name' => 'Botswana'),
      array('iso_3166-1_alpha-2' => 'BV', 'name' => 'Bouvet Island'),
      array('iso_3166-1_alpha-2' => 'BR', 'name' => 'Brazil'),
      array('iso_3166-1_alpha-2' => 'IO', 'name' => 'British lndian Ocean Territory'),
      array('iso_3166-1_alpha-2' => 'BN', 'name' => 'Brunei Darussalam'),
      array('iso_3166-1_alpha-2' => 'BG', 'name' => 'Bulgaria'),
      array('iso_3166-1_alpha-2' => 'BF', 'name' => 'Burkina Faso'),
      array('iso_3166-1_alpha-2' => 'BI', 'name' => 'Burundi'),
      array('iso_3166-1_alpha-2' => 'KH', 'name' => 'Cambodia'),
      array('iso_3166-1_alpha-2' => 'CM', 'name' => 'Cameroon'),
      array('iso_3166-1_alpha-2' => 'CV', 'name' => 'Cape Verde'),
      array('iso_3166-1_alpha-2' => 'KY', 'name' => 'Cayman Islands'),
      array('iso_3166-1_alpha-2' => 'CF', 'name' => 'Central African Republic'),
      array('iso_3166-1_alpha-2' => 'TD', 'name' => 'Chad'),
      array('iso_3166-1_alpha-2' => 'CL', 'name' => 'Chile'),
      array('iso_3166-1_alpha-2' => 'CN', 'name' => 'China'),
      array('iso_3166-1_alpha-2' => 'CX', 'name' => 'Christmas Island'),
      array('iso_3166-1_alpha-2' => 'CC', 'name' => 'Cocos (Keeling) Islands'),
      array('iso_3166-1_alpha-2' => 'CO', 'name' => 'Colombia'),
      array('iso_3166-1_alpha-2' => 'KM', 'name' => 'Comoros'),
      array('iso_3166-1_alpha-2' => 'CG', 'name' => 'Congo'),
      array('iso_3166-1_alpha-2' => 'CK', 'name' => 'Cook Islands'),
      array('iso_3166-1_alpha-2' => 'CR', 'name' => 'Costa Rica'),
      array('iso_3166-1_alpha-2' => 'HR', 'name' => 'Croatia (Hrvatska)'),
      array('iso_3166-1_alpha-2' => 'CU', 'name' => 'Cuba'),
      array('iso_3166-1_alpha-2' => 'CY', 'name' => 'Cyprus'),
      array('iso_3166-1_alpha-2' => 'CZ', 'name' => 'Czech Republic'),
      array('iso_3166-1_alpha-2' => 'CD', 'name' => 'Democratic Republic of Congo'),
      array('iso_3166-1_alpha-2' => 'DK', 'name' => 'Denmark'),
      array('iso_3166-1_alpha-2' => 'DJ', 'name' => 'Djibouti'),
      array('iso_3166-1_alpha-2' => 'DM', 'name' => 'Dominica'),
      array('iso_3166-1_alpha-2' => 'DO', 'name' => 'Dominican Republic'),
      array('iso_3166-1_alpha-2' => 'TP', 'name' => 'East Timor'),
      array('iso_3166-1_alpha-2' => 'EC', 'name' => 'Ecudaor'),
      array('iso_3166-1_alpha-2' => 'EG', 'name' => 'Egypt'),
      array('iso_3166-1_alpha-2' => 'SV', 'name' => 'El Salvador'),
      array('iso_3166-1_alpha-2' => 'GQ', 'name' => 'Equatorial Guinea'),
      array('iso_3166-1_alpha-2' => 'ER', 'name' => 'Eritrea'),
      array('iso_3166-1_alpha-2' => 'EE', 'name' => 'Estonia'),
      array('iso_3166-1_alpha-2' => 'ET', 'name' => 'Ethiopia'),
      array('iso_3166-1_alpha-2' => 'FK', 'name' => 'Falkland Islands (Malvinas)'),
      array('iso_3166-1_alpha-2' => 'FO', 'name' => 'Faroe Islands'),
      array('iso_3166-1_alpha-2' => 'FJ', 'name' => 'Fiji'),
      array('iso_3166-1_alpha-2' => 'FI', 'name' => 'Finland'),
      //array('iso_3166-1_alpha-2' => 'FR', 'name' => 'France', 'activated' => true),
      array('iso_3166-1_alpha-2' => 'FX', 'name' => 'France, Metropolitan'),
      array('iso_3166-1_alpha-2' => 'GF', 'name' => 'French Guiana'),
      array('iso_3166-1_alpha-2' => 'PF', 'name' => 'French Polynesia'),
      array('iso_3166-1_alpha-2' => 'TF', 'name' => 'French Southern Territories'),
      array('iso_3166-1_alpha-2' => 'GA', 'name' => 'Gabon'),
      array('iso_3166-1_alpha-2' => 'GM', 'name' => 'Gambia'),
      array('iso_3166-1_alpha-2' => 'GE', 'name' => 'Georgia'),
      array('iso_3166-1_alpha-2' => 'DE', 'name' => 'Germany'),
      array('iso_3166-1_alpha-2' => 'GH', 'name' => 'Ghana'),
      array('iso_3166-1_alpha-2' => 'GI', 'name' => 'Gibraltar'),
      array('iso_3166-1_alpha-2' => 'GR', 'name' => 'Greece'),
      array('iso_3166-1_alpha-2' => 'GL', 'name' => 'Greenland'),
      array('iso_3166-1_alpha-2' => 'GD', 'name' => 'Grenada'),
      array('iso_3166-1_alpha-2' => 'GP', 'name' => 'Guadeloupe'),
      array('iso_3166-1_alpha-2' => 'GU', 'name' => 'Guam'),
      array('iso_3166-1_alpha-2' => 'GT', 'name' => 'Guatemala'),
      array('iso_3166-1_alpha-2' => 'GN', 'name' => 'Guinea'),
      array('iso_3166-1_alpha-2' => 'GW', 'name' => 'Guinea-Bissau'),
      array('iso_3166-1_alpha-2' => 'GY', 'name' => 'Guyana'),
      array('iso_3166-1_alpha-2' => 'HT', 'name' => 'Haiti'),
      array('iso_3166-1_alpha-2' => 'HM', 'name' => 'Heard and Mc Donald Islands'),
      array('iso_3166-1_alpha-2' => 'HN', 'name' => 'Honduras'),
      array('iso_3166-1_alpha-2' => 'HK', 'name' => 'Hong Kong'),
      array('iso_3166-1_alpha-2' => 'HU', 'name' => 'Hungary'),
      array('iso_3166-1_alpha-2' => 'IS', 'name' => 'Iceland'),
      array('iso_3166-1_alpha-2' => 'IN', 'name' => 'India'),
      array('iso_3166-1_alpha-2' => 'ID', 'name' => 'Indonesia'),
      array('iso_3166-1_alpha-2' => 'IR', 'name' => 'Iran (Islamic Republic of)'),
      array('iso_3166-1_alpha-2' => 'IQ', 'name' => 'Iraq'),
      array('iso_3166-1_alpha-2' => 'IE', 'name' => 'Ireland'),
      array('iso_3166-1_alpha-2' => 'IL', 'name' => 'Israel'),
      array('iso_3166-1_alpha-2' => 'IT', 'name' => 'Italy'),
      array('iso_3166-1_alpha-2' => 'CI', 'name' => 'Ivory Coast'),
      array('iso_3166-1_alpha-2' => 'JM', 'name' => 'Jamaica'),
      array('iso_3166-1_alpha-2' => 'JP', 'name' => 'Japan'),
      array('iso_3166-1_alpha-2' => 'JO', 'name' => 'Jordan'),
      array('iso_3166-1_alpha-2' => 'KZ', 'name' => 'Kazakhstan'),
      array('iso_3166-1_alpha-2' => 'KE', 'name' => 'Kenya'),
      array('iso_3166-1_alpha-2' => 'KI', 'name' => 'Kiribati'),
      array('iso_3166-1_alpha-2' => 'KP', 'name' => 'Korea, Democratic People\'s Republic of'),
      array('iso_3166-1_alpha-2' => 'KR', 'name' => 'Korea, Republic of'),
      array('iso_3166-1_alpha-2' => 'KW', 'name' => 'Kuwait'),
      array('iso_3166-1_alpha-2' => 'KG', 'name' => 'Kyrgyzstan'),
      array('iso_3166-1_alpha-2' => 'LA', 'name' => 'Lao People\'s Democratic Republic'),
      array('iso_3166-1_alpha-2' => 'LV', 'name' => 'Latvia'),
      array('iso_3166-1_alpha-2' => 'LB', 'name' => 'Lebanon'),
      array('iso_3166-1_alpha-2' => 'LS', 'name' => 'Lesotho'),
      array('iso_3166-1_alpha-2' => 'LR', 'name' => 'Liberia'),
      array('iso_3166-1_alpha-2' => 'LY', 'name' => 'Libyan Arab Jamahiriya'),
      array('iso_3166-1_alpha-2' => 'LI', 'name' => 'Liechtenstein'),
      array('iso_3166-1_alpha-2' => 'LT', 'name' => 'Lithuania'),
      array('iso_3166-1_alpha-2' => 'LU', 'name' => 'Luxembourg'),
      array('iso_3166-1_alpha-2' => 'MO', 'name' => 'Macau'),
      array('iso_3166-1_alpha-2' => 'MK', 'name' => 'Macedonia'),
      array('iso_3166-1_alpha-2' => 'MG', 'name' => 'Madagascar'),
      array('iso_3166-1_alpha-2' => 'MW', 'name' => 'Malawi'),
      array('iso_3166-1_alpha-2' => 'MY', 'name' => 'Malaysia'),
      array('iso_3166-1_alpha-2' => 'MV', 'name' => 'Maldives'),
      array('iso_3166-1_alpha-2' => 'ML', 'name' => 'Mali'),
      array('iso_3166-1_alpha-2' => 'MT', 'name' => 'Malta'),
      array('iso_3166-1_alpha-2' => 'MH', 'name' => 'Marshall Islands'),
      array('iso_3166-1_alpha-2' => 'MQ', 'name' => 'Martinique'),
      array('iso_3166-1_alpha-2' => 'MR', 'name' => 'Mauritania'),
      array('iso_3166-1_alpha-2' => 'MU', 'name' => 'Mauritius'),
      array('iso_3166-1_alpha-2' => 'TY', 'name' => 'Mayotte'),
      array('iso_3166-1_alpha-2' => 'MX', 'name' => 'Mexico'),
      array('iso_3166-1_alpha-2' => 'FM', 'name' => 'Micronesia, Federated States of'),
      array('iso_3166-1_alpha-2' => 'MD', 'name' => 'Moldova, Republic of'),
      array('iso_3166-1_alpha-2' => 'MC', 'name' => 'Monaco'),
      array('iso_3166-1_alpha-2' => 'MN', 'name' => 'Mongolia'),
      array('iso_3166-1_alpha-2' => 'MS', 'name' => 'Montserrat'),
      array('iso_3166-1_alpha-2' => 'MA', 'name' => 'Morocco'),
      array('iso_3166-1_alpha-2' => 'MZ', 'name' => 'Mozambique'),
      array('iso_3166-1_alpha-2' => 'MM', 'name' => 'Myanmar'),
      array('iso_3166-1_alpha-2' => 'NA', 'name' => 'Namibia'),
      array('iso_3166-1_alpha-2' => 'NR', 'name' => 'Nauru'),
      array('iso_3166-1_alpha-2' => 'NP', 'name' => 'Nepal'),
      array('iso_3166-1_alpha-2' => 'NL', 'name' => 'Netherlands'),
      array('iso_3166-1_alpha-2' => 'NC', 'name' => 'New Caledonia'),
      array('iso_3166-1_alpha-2' => 'NZ', 'name' => 'New Zealand'),
      array('iso_3166-1_alpha-2' => 'NI', 'name' => 'Nicaragua'),
      array('iso_3166-1_alpha-2' => 'NE', 'name' => 'Niger'),
      array('iso_3166-1_alpha-2' => 'NG', 'name' => 'Nigeria'),
      array('iso_3166-1_alpha-2' => 'NU', 'name' => 'Niue'),
      array('iso_3166-1_alpha-2' => 'NF', 'name' => 'Norfork Island'),
      array('iso_3166-1_alpha-2' => 'MP', 'name' => 'Northern Mariana Islands'),
      array('iso_3166-1_alpha-2' => 'NO', 'name' => 'Norway'),
      array('iso_3166-1_alpha-2' => 'OM', 'name' => 'Oman'),
      array('iso_3166-1_alpha-2' => 'PK', 'name' => 'Pakistan'),
      array('iso_3166-1_alpha-2' => 'PW', 'name' => 'Palau'),
      array('iso_3166-1_alpha-2' => 'PA', 'name' => 'Panama'),
      array('iso_3166-1_alpha-2' => 'PG', 'name' => 'Papua New Guinea'),
      array('iso_3166-1_alpha-2' => 'PY', 'name' => 'Paraguay'),
      array('iso_3166-1_alpha-2' => 'PE', 'name' => 'Peru'),
      array('iso_3166-1_alpha-2' => 'PH', 'name' => 'Philippines'),
      array('iso_3166-1_alpha-2' => 'PN', 'name' => 'Pitcairn'),
      array('iso_3166-1_alpha-2' => 'PL', 'name' => 'Poland'),
      array('iso_3166-1_alpha-2' => 'PT', 'name' => 'Portugal'),
      array('iso_3166-1_alpha-2' => 'PR', 'name' => 'Puerto Rico'),
      array('iso_3166-1_alpha-2' => 'QA', 'name' => 'Qatar'),
      array('iso_3166-1_alpha-2' => 'SS', 'name' => 'Republic of South Sudan'),
      array('iso_3166-1_alpha-2' => 'RE', 'name' => 'Reunion'),
      array('iso_3166-1_alpha-2' => 'RO', 'name' => 'Romania'),
      array('iso_3166-1_alpha-2' => 'RU', 'name' => 'Russian Federation'),
      array('iso_3166-1_alpha-2' => 'RW', 'name' => 'Rwanda'),
      array('iso_3166-1_alpha-2' => 'KN', 'name' => 'Saint Kitts and Nevis'),
      array('iso_3166-1_alpha-2' => 'LC', 'name' => 'Saint Lucia'),
      array('iso_3166-1_alpha-2' => 'VC', 'name' => 'Saint Vincent and the Grenadines'),
      array('iso_3166-1_alpha-2' => 'WS', 'name' => 'Samoa'),
      array('iso_3166-1_alpha-2' => 'SM', 'name' => 'San Marino'),
      array('iso_3166-1_alpha-2' => 'ST', 'name' => 'Sao Tome and Principe'),
      array('iso_3166-1_alpha-2' => 'SA', 'name' => 'Saudi Arabia'),
      array('iso_3166-1_alpha-2' => 'SN', 'name' => 'Senegal'),
      array('iso_3166-1_alpha-2' => 'RS', 'name' => 'Serbia'),
      array('iso_3166-1_alpha-2' => 'SC', 'name' => 'Seychelles'),
      array('iso_3166-1_alpha-2' => 'SL', 'name' => 'Sierra Leone'),
      array('iso_3166-1_alpha-2' => 'SG', 'name' => 'Singapore'),
      array('iso_3166-1_alpha-2' => 'SK', 'name' => 'Slovakia'),
      array('iso_3166-1_alpha-2' => 'SI', 'name' => 'Slovenia'),
      array('iso_3166-1_alpha-2' => 'SB', 'name' => 'Solomon Islands'),
      array('iso_3166-1_alpha-2' => 'SO', 'name' => 'Somalia'),
      array('iso_3166-1_alpha-2' => 'ZA', 'name' => 'South Africa'),
      array('iso_3166-1_alpha-2' => 'GS', 'name' => 'South Georgia South Sandwich Islands'),
      array('iso_3166-1_alpha-2' => 'ES', 'name' => 'Spain'),
      array('iso_3166-1_alpha-2' => 'LK', 'name' => 'Sri Lanka'),
      array('iso_3166-1_alpha-2' => 'SH', 'name' => 'St. Helena'),
      array('iso_3166-1_alpha-2' => 'PM', 'name' => 'St. Pierre and Miquelon'),
      array('iso_3166-1_alpha-2' => 'SD', 'name' => 'Sudan'),
      array('iso_3166-1_alpha-2' => 'SR', 'name' => 'Suriname'),
      array('iso_3166-1_alpha-2' => 'SJ', 'name' => 'Svalbarn and Jan Mayen Islands'),
      array('iso_3166-1_alpha-2' => 'SZ', 'name' => 'Swaziland'),
      array('iso_3166-1_alpha-2' => 'SE', 'name' => 'Sweden'),
      array('iso_3166-1_alpha-2' => 'CH', 'name' => 'Switzerland'),
      array('iso_3166-1_alpha-2' => 'SY', 'name' => 'Syrian Arab Republic'),
      array('iso_3166-1_alpha-2' => 'TW', 'name' => 'Taiwan'),
      array('iso_3166-1_alpha-2' => 'TJ', 'name' => 'Tajikistan'),
      array('iso_3166-1_alpha-2' => 'TZ', 'name' => 'Tanzania, United Republic of'),
      array('iso_3166-1_alpha-2' => 'TH', 'name' => 'Thailand'),
      array('iso_3166-1_alpha-2' => 'TG', 'name' => 'Togo'),
      array('iso_3166-1_alpha-2' => 'TK', 'name' => 'Tokelau'),
      array('iso_3166-1_alpha-2' => 'TO', 'name' => 'Tonga'),
      array('iso_3166-1_alpha-2' => 'TT', 'name' => 'Trinidad and Tobago'),
      array('iso_3166-1_alpha-2' => 'TN', 'name' => 'Tunisia'),
      array('iso_3166-1_alpha-2' => 'TR', 'name' => 'Turkey'),
      array('iso_3166-1_alpha-2' => 'TM', 'name' => 'Turkmenistan'),
      array('iso_3166-1_alpha-2' => 'TC', 'name' => 'Turks and Caicos Islands'),
      array('iso_3166-1_alpha-2' => 'TV', 'name' => 'Tuvalu'),
      array('iso_3166-1_alpha-2' => 'UG', 'name' => 'Uganda'),
      array('iso_3166-1_alpha-2' => 'UA', 'name' => 'Ukraine'),
      array('iso_3166-1_alpha-2' => 'AE', 'name' => 'United Arab Emirates'),
      array('iso_3166-1_alpha-2' => 'GB', 'name' => 'United Kingdom'),
      array('iso_3166-1_alpha-2' => 'UM', 'name' => 'United States minor outlying islands'),
      array('iso_3166-1_alpha-2' => 'UY', 'name' => 'Uruguay'),
      array('iso_3166-1_alpha-2' => 'UZ', 'name' => 'Uzbekistan'),
      array('iso_3166-1_alpha-2' => 'VU', 'name' => 'Vanuatu'),
      array('iso_3166-1_alpha-2' => 'VA', 'name' => 'Vatican City State'),
      array('iso_3166-1_alpha-2' => 'VE', 'name' => 'Venezuela'),
      array('iso_3166-1_alpha-2' => 'VN', 'name' => 'Vietnam'),
      array('iso_3166-1_alpha-2' => 'VG', 'name' => 'Virgin Islands (British)'),
      array('iso_3166-1_alpha-2' => 'VI', 'name' => 'Virgin Islands (U.S.)'),
      array('iso_3166-1_alpha-2' => 'WF', 'name' => 'Wallis and Futuna Islands'),
      array('iso_3166-1_alpha-2' => 'EH', 'name' => 'Western Sahara'),
      array('iso_3166-1_alpha-2' => 'YE', 'name' => 'Yemen'),
      array('iso_3166-1_alpha-2' => 'ZM', 'name' => 'Zambia'),
      array('iso_3166-1_alpha-2' => 'ZW', 'name' => 'Zimbabwe')
    );

    foreach ($countries as $country) {
      DB::table('countries')->insert($country);
    }
  }
}
