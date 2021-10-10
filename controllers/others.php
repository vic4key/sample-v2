<?php

namespace Controller;

require_once "commons/cloudflare.interface.php";

class Others
{
  public function cf_time_series($time)
  {
    $arg = \strtolower($time);

    $time = null;

    if ($arg == "day")
    {
      $time = \CF_UV_DAY;
    }
    else if ($arg == "week")
    {
      $time = \CF_UV_WEEK;
    }
    else if ($arg == "month")
    {
      $time = \CF_UV_MONTH;
    }

    $result = \ICloudFlare::Instance()->QueryTimeSeries($time);
    return \Flight::json($result);
  }
}

?>