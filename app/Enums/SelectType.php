<?php

namespace App\Enums;



enum SelectType: string
{
  case address = 'address';
  case country = 'country';
  case country_flag = 'country_flag';
  case language = 'language';
  case currency = 'currency';
}
