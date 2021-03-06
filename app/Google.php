<?php

namespace App;

use Illuminate\Http\Request;
use App\Google;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Google_Service_AnalyticsReporting_DateRange;
use Google_Service_AnalyticsReporting_Metric;
use Google_Service_AnalyticsReporting_Dimension;
use Google_Service_AnalyticsReporting_SegmentDimensionFilter;
use Google_Service_AnalyticsReporting_DimensionFilterClause;
use Google_Service_AnalyticsReporting_OrderBy;
use Google_Service_AnalyticsReporting_ReportRequest;
use Google_Service_AnalyticsReporting_GetReportsRequest;
use Google_Service_Webmasters_SearchAnalyticsQueryRequest;
use Google_Service_Webmasters_ApiDimensionFilter;
use Google_Service_Webmasters_ApiDimensionFilterGroup;
use Google_Service_AnalyticsReporting_Segment;

class Google extends Model {
    public function client()
{
        $client_id = "781086260859-snov5g13jr20rjjttpkoamka7r7mjlet.apps.googleusercontent.com";
        $client_secret = "zxnH0Tn1MqzKEVQgFlVJf-Jv";
        $redirect_url = "http://localhost:8888/accounts.google";
        $KEY_FILE_LOCATION = __DIR__ . '/client_secrets.json';
        $gScope = "https://www.googleapis.com/auth/analytics,https://www.googleapis.com/auth/webmasters.readonly";
        $access_type = "offline";
        $approval_prompt= "force";
        $client = new \Google_Client();
        $client->setClientId($client_id);
        $client->setClientSecret($client_secret);
        $client->setRedirectUri($redirect_url);
        $client->setScopes(explode(',', $gScope));
        $client->setAuthConfigFile($KEY_FILE_LOCATION);
        $client->setApprovalPrompt($approval_prompt);
        $client->setAccessType($access_type);
        return $client;
    }

    public function get_properties($client)
    {
        $array = $client->management_webproperties->listManagementWebproperties('~all');
        return $array;
    }

    public function get_account_data($properties)
    {
        $name = [];
        foreach ($properties as $key => $value) {
            array_push(
                $name,
                array(
                  $value->accountId,
                  $value->name,
                  $value->websiteUrl,
                  $value->id,
                  $value->defaultProfileId,
                )
            );
        }
        return $name;
    }

    public function get_ga_data($analytics, $VIEW_ID, $start, $end, $comStart, $comEnd)
    {
        $dateRange = new Google_Service_AnalyticsReporting_DateRange();
        $dateRange->setStartDate($start);
        $dateRange->setEndDate($end);
        $dateRangeTwo = new Google_Service_AnalyticsReporting_DateRange();
        $dateRangeTwo->setStartDate($comStart);
        $dateRangeTwo->setEndDate($comEnd);
        $ss = new Google_Service_AnalyticsReporting_Metric();
        $ss->setExpression('ga:sessions');
        $ps = new Google_Service_AnalyticsReporting_Metric();
        $ps->setExpression('ga:pageviewsPerSession');
        $up = new Google_Service_AnalyticsReporting_Metric();
        $up->setExpression('ga:users');
        $time = new Google_Service_AnalyticsReporting_Metric();
        $time->setExpression('ga:avgTimeOnPage');
        $br = new Google_Service_AnalyticsReporting_Metric();
        $br->setExpression('ga:bounceRate');
        $aveSs = new Google_Service_AnalyticsReporting_Metric();
        $aveSs->setExpression('ga:avgSessionDuration');
        $pv = new Google_Service_AnalyticsReporting_Metric();
        $pv->setExpression('ga:pageviews');
        $exit = new Google_Service_AnalyticsReporting_Metric();
        $exit->setExpression('ga:exitRate');
        $date = new Google_Service_AnalyticsReporting_Dimension();
        $date->setName('ga:date');
        $orderBy = new Google_Service_AnalyticsReporting_OrderBy();
        $orderBy->setFieldName('ga:sessions');
        $request = new Google_Service_AnalyticsReporting_ReportRequest();
        $request->setViewId($VIEW_ID);
        $request->setDateRanges(array($dateRange,$dateRangeTwo));
        $request->setMetrics(array($ss, $ps, $up, $time, $br, $aveSs, $pv, $exit));
        $requestUser = new Google_Service_AnalyticsReporting_ReportRequest();
        $requestUser->setViewId($VIEW_ID);
        $requestUser->setDateRanges(array($dateRange, $dateRangeTwo));
        $requestUser->setMetrics($up);
        $requestUser->setDimensions($date);
        $body = new Google_Service_AnalyticsReporting_GetReportsRequest();
        $body->setReportRequests(array($request, $requestUser));
        $result = $analytics->reports->batchGet($body)->reports[0]->data->totals;
        $resultUsers = $analytics->reports->batchGet($body)->reports[1]->data->rows;
        // dd($resultUsers);
        $arrayUser = [];
        $array = [];
        foreach ($resultUsers as $i => $resultUser) {
          $day = date('Y-m-d', strtotime($resultUser->dimensions[0]));
          if ($i <= 29) {
          $user = $resultUser->metrics[1]->values[0];
          $arrayUser['compare'][$day] = $user;
          }
          if ($i >=30) {
          $user = $resultUser->metrics[0]->values[0];
            $arrayUser['original'][$day] = $user;
          }
          $i++;
        }
        foreach ($result as $value) {
          $value = $value->values;
          array_push($array, $value);
        }
        // dd($array,$arrayUser);
        return [$array,$arrayUser];
    }
    public function get_ga_user($analytics, $VIEW_ID, $start, $end, $comStart, $comEnd)
    {
        $dateRange = new Google_Service_AnalyticsReporting_DateRange();
        $dateRange->setStartDate($start);
        $dateRange->setEndDate($end);
        $dateRangeTwo = new Google_Service_AnalyticsReporting_DateRange();
        $dateRangeTwo->setStartDate($comStart);
        $dateRangeTwo->setEndDate($comEnd);
        $city = new Google_Service_AnalyticsReporting_Dimension();
        $city->setName('ga:city');
        $country = new Google_Service_AnalyticsReporting_Dimension();
        $country->setName('ga:country');
        $gender = new Google_Service_AnalyticsReporting_Dimension();
        $gender->setName('ga:userGender');
        $age = new Google_Service_AnalyticsReporting_Dimension();
        $age->setName('ga:userAgeBracket');
        $device = new Google_Service_AnalyticsReporting_Dimension();
        $device->setName('ga:deviceCategory');
        $userType = new Google_Service_AnalyticsReporting_Dimension();
        $userType->setName('ga:userType');
        $ss = new Google_Service_AnalyticsReporting_Metric();
        $ss->setExpression('ga:sessions');
        $ss->setAlias('ss');
        $orderBy = new Google_Service_AnalyticsReporting_OrderBy();
        $orderBy->setFieldName('ga:sessions');
        $orderBy->setSortOrder('DESCENDING');
        $requestCity = new Google_Service_AnalyticsReporting_ReportRequest();
        $requestCity->setViewId($VIEW_ID);
        $requestCity->setDateRanges(array($dateRange,$dateRangeTwo));
        $requestCity->setMetrics($ss);
        $requestCity->setDimensions($city);
        $requestCity->setOrderBys($orderBy);
        $requestCity->setPageSize('5');
        $requestCountry = new Google_Service_AnalyticsReporting_ReportRequest();
        $requestCountry->setViewId($VIEW_ID);
        $requestCountry->setDateRanges(array($dateRange,$dateRangeTwo));
        $requestCountry->setMetrics($ss);
        $requestCountry->setDimensions($country);
        $requestCountry->setOrderBys($orderBy);
        $requestCountry->setPageSize('5');
        $requestGender = new Google_Service_AnalyticsReporting_ReportRequest();
        $requestGender->setViewId($VIEW_ID);
        $requestGender->setDateRanges(array($dateRange,$dateRangeTwo));
        $requestGender->setMetrics($ss);
        $requestGender->setDimensions($gender);
        $requestGender->setOrderBys($orderBy);
        $requestAge = new Google_Service_AnalyticsReporting_ReportRequest();
        $requestAge->setViewId($VIEW_ID);
        $requestAge->setDateRanges(array($dateRange,$dateRangeTwo));
        $requestAge->setMetrics($ss);
        $requestAge->setDimensions($age);
        $requestAge->setOrderBys($orderBy);
        $requestDevice = new Google_Service_AnalyticsReporting_ReportRequest();
        $requestDevice->setViewId($VIEW_ID);
        $requestDevice->setDateRanges(array($dateRange,$dateRangeTwo));
        $requestDevice->setMetrics($ss);
        $requestDevice->setDimensions($device);
        $requestDevice->setOrderBys($orderBy);
        $requestUserType = new Google_Service_AnalyticsReporting_ReportRequest();
        $requestUserType->setViewId($VIEW_ID);
        $requestUserType->setDateRanges(array($dateRange,$dateRangeTwo));
        $requestUserType->setMetrics($ss);
        $requestUserType->setDimensions($userType);
        $body = new Google_Service_AnalyticsReporting_GetReportsRequest();
        $body->setReportRequests(array($requestCountry, $requestCity, $requestAge));
        $bodyTwo = new Google_Service_AnalyticsReporting_GetReportsRequest();
        $bodyTwo->setReportRequests(array($requestUserType, $requestDevice, $requestGender));
        $reports = $analytics->reports->batchGet($body)->reports;
        $reportsTwo = $analytics->reports->batchGet($bodyTwo)->reports;
        $number = [];
        $numberUser = [];
        foreach ($reportsTwo as $i => $value) {
            $rows = $value->data->rows;
            foreach ($rows as $key => $val) {
              $dimension = $val->dimensions[0];
              $number[$i][$dimension] = [$val->metrics[0]->values[0],$val->metrics[1]->values[0]];
            }
        }
        foreach ($reports as $i => $value) {
          $rows = $value->data->rows;
          foreach ( $rows as $key => $val) {
            $numberUser[$i][] = [$val->dimensions[0], $val->metrics[0]->values[0], $val->metrics[1]->values[0]];
          }
        }

        // $a = [$number,$numberUser];
        // dd($a);
        return [$number,$numberUser];
      }

    public function get_ga_inflow($analytics, $VIEW_ID, $start, $end, $comStart, $comEnd)
    {
        $dateRange = new Google_Service_AnalyticsReporting_DateRange();
        $dateRange->setStartDate($start);
        $dateRange->setEndDate($end);
        $dateRangeTwo = new Google_Service_AnalyticsReporting_DateRange();
        $dateRangeTwo->setStartDate($comStart);
        $dateRangeTwo->setEndDate($comEnd);
        $medium = new Google_Service_AnalyticsReporting_Dimension();
        $medium->setName('ga:channelGrouping');
        $social = new Google_Service_AnalyticsReporting_Dimension();
        $social->setName('ga:socialNetwork');
        $referral = new Google_Service_AnalyticsReporting_Dimension();
        $referral->setName('ga:source');
        $ss = new Google_Service_AnalyticsReporting_Metric();
        $ss->setExpression('ga:sessions');
        $ss->setAlias('ss');
        $orderBy = new Google_Service_AnalyticsReporting_OrderBy();
        $orderBy->setFieldName('ga:sessions');
        $orderBy->setSortOrder('DESCENDING');
        $requestMedium = new Google_Service_AnalyticsReporting_ReportRequest();
        $requestMedium->setViewId($VIEW_ID);
        $requestMedium->setDateRanges(array($dateRange,$dateRangeTwo));
        $requestMedium->setMetrics($ss);
        $requestMedium->setDimensions($medium);
        $requestMedium->setOrderBys($orderBy);
        $requestSocial = new Google_Service_AnalyticsReporting_ReportRequest();
        $requestSocial->setViewId($VIEW_ID);
        $requestSocial->setDateRanges(array($dateRange,$dateRangeTwo));
        $requestSocial->setMetrics($ss);
        $requestSocial->setDimensions($social);
        $requestSocial->setOrderBys($orderBy);
        $requestReferral = new Google_Service_AnalyticsReporting_ReportRequest();
        $requestReferral->setViewId($VIEW_ID);
        $requestReferral->setDateRanges(array($dateRange,$dateRangeTwo));
        $requestReferral->setMetrics($ss);
        $requestReferral->setDimensions($referral);
        $requestReferral->setOrderBys($orderBy);
        $requestReferral->setPageSize('5');
        $body = new Google_Service_AnalyticsReporting_GetReportsRequest();
        $body->setReportRequests(array($requestMedium,$requestSocial,$requestReferral));
        $reports = $analytics->reports->batchGet($body)->reports;
        $number = [];
        $result = [];
        foreach ($reports as $i => $value) {
          $rows = $value->data->rows;
          foreach ( $rows as $key => $val) {
            $number[$i][] = [$val->dimensions[0], $val->metrics[0]->values[0],$val->metrics[1]->values[0]];
          }
        }
        return $number;
      }

    public function get_ga_action($analytics, $VIEW_ID, $start, $end, $comStart, $comEnd)
    {
        $dateRange = new Google_Service_AnalyticsReporting_DateRange();
        $dateRange->setStartDate($start);
        $dateRange->setEndDate($end);
        $dateRangeTwo = new Google_Service_AnalyticsReporting_DateRange();
        $dateRangeTwo->setStartDate($comStart);
        $dateRangeTwo->setEndDate($comEnd);
        $action = new Google_Service_AnalyticsReporting_Dimension();
        $action->setName('ga:pagePath');
        $up = new Google_Service_AnalyticsReporting_Metric();
        $up->setExpression('ga:users');
        $br = new Google_Service_AnalyticsReporting_Metric();
        $br->setExpression('ga:bounceRate');
        $ps = new Google_Service_AnalyticsReporting_Metric();
        $ps->setExpression('ga:pageviewsPerSession');
        $time = new Google_Service_AnalyticsReporting_Metric();
        $time->setExpression('ga:avgTimeOnPage');
        $ss = new Google_Service_AnalyticsReporting_Metric();
        $ss->setExpression('ga:sessions');
        $pv = new Google_Service_AnalyticsReporting_Metric();
        $pv->setExpression('ga:pageviews');
        $orderBy = new Google_Service_AnalyticsReporting_OrderBy();
        $orderBy->setFieldName('ga:sessions');
        $orderBy->setSortOrder('DESCENDING');
        $request = new Google_Service_AnalyticsReporting_ReportRequest();
        $request->setViewId($VIEW_ID);
        $request->setDateRanges(array($dateRange, $dateRangeTwo));
        $request->setDimensions($action);
        $request->setMetrics(array($ss,$pv,$ps,$up,$time,$br));
        $request->setOrderBys($orderBy);
        $request->setPageSize('10');
        $body = new Google_Service_AnalyticsReporting_GetReportsRequest();
        $body->setReportRequests(array($request));
        $reports = $analytics->reports->batchGet($body);
        $reports = $reports[0]->data->rows;
        foreach ($reports as $key => $report) {
          $number[$key][0][] = [$report->dimensions,$report->metrics[0]->values[0],$report->metrics[0]->values[1],$report->metrics[0]->values[2],$report->metrics[0]->values[3],$report->metrics[0]->values[4],$report->metrics[0]->values[5]];
          $number[$key][1][]= [$report->dimensions,$report->metrics[1]->values[0],$report->metrics[1]->values[1],$report->metrics[1]->values[2],$report->metrics[1]->values[3],$report->metrics[1]->values[4],$report->metrics[1]->values[5]];
        }
        return $number;
    }

    public function get_ga_cv($analytics, $VIEW_ID, $start, $end, $comStart, $comEnd)
    {
        $dateRange = new Google_Service_AnalyticsReporting_DateRange();
        $dateRange->setStartDate($start);
        $dateRange->setEndDate($end);
        $dateRangeTwo = new Google_Service_AnalyticsReporting_DateRange();
        $dateRangeTwo->setStartDate($comStart);
        $dateRangeTwo->setEndDate($comEnd);
        $action = new Google_Service_AnalyticsReporting_Dimension();
        $action->setName('ga:sourceMedium');
        $ss = new Google_Service_AnalyticsReporting_Metric();
        $ss->setExpression('ga:sessions');
        $up = new Google_Service_AnalyticsReporting_Metric();
        $up->setExpression('ga:users');
        $br = new Google_Service_AnalyticsReporting_Metric();
        $br->setExpression('ga:bounceRate');
        $ps = new Google_Service_AnalyticsReporting_Metric();
        $ps->setExpression('ga:pageviewsPerSession');
        $time = new Google_Service_AnalyticsReporting_Metric();
        $time->setExpression('ga:avgTimeOnPage');
        $cv = new Google_Service_AnalyticsReporting_Metric();
        $cv->setExpression('ga:goalCompletionsAll');
        $cvr = new Google_Service_AnalyticsReporting_Metric();
        $cvr->setExpression('ga:goalConversionRateAll');
        $orderBy = new Google_Service_AnalyticsReporting_OrderBy();
        $orderBy->setFieldName('ga:users');
        $orderBy->setSortOrder('DESCENDING');
        $request = new Google_Service_AnalyticsReporting_ReportRequest();
        $request->setViewId($VIEW_ID);
        $request->setDateRanges(array($dateRange, $dateRangeTwo));
        $request->setDimensions($action);
        $request->setMetrics(array($cv,$cvr,$up,$br,$ps,$time));
        $request->setOrderBys($orderBy);
        $request->setPageSize('10');
        $requestTwo = new Google_Service_AnalyticsReporting_ReportRequest();
        $requestTwo->setViewId($VIEW_ID);
        $requestTwo->setDateRanges(array($dateRange,$dateRangeTwo));
        $requestTwo->setMetrics(array($ss, $cv, $cvr, $br));

        $body = new Google_Service_AnalyticsReporting_GetReportsRequest();
        $body->setReportRequests(array($request, $requestTwo));
        $reports = $analytics->reports->batchGet($body);
        $reportsOne = $reports[0]->data->rows;
        $reportsTwo = $reports[1]->data->totals;
        foreach ($reportsOne as $key => $report) {
          $number[$key][0][] = [$report->dimensions,$report->metrics[0]->values[0],$report->metrics[0]->values[1],$report->metrics[0]->values[2],$report->metrics[0]->values[3],$report->metrics[0]->values[4],$report->metrics[0]->values[5]];
          $number[$key][1][]= [$report->dimensions,$report->metrics[1]->values[0],$report->metrics[1]->values[1],$report->metrics[1]->values[2],$report->metrics[1]->values[3],$report->metrics[1]->values[4],$report->metrics[1]->values[5]];
        }

        $array = [];
        foreach ($reportsTwo as $value) {
          $value = $value->values;
          array_push($array, $value);
        }
        // dd($number,$array);
        return [$number,$array];
    }

    public function get_ga_ad($analytics, $VIEW_ID, $start, $end, $comStart, $comEnd){
      $dateRange = new Google_Service_AnalyticsReporting_DateRange();
      $dateRange->setStartDate($start);
      $dateRange->setEndDate($end);
      $dateRangeTwo = new Google_Service_AnalyticsReporting_DateRange();
      $dateRangeTwo->setStartDate($comStart);
      $dateRangeTwo->setEndDate($comEnd);
      $query = new Google_Service_AnalyticsReporting_Dimension();
      $query->setName('ga:adMatchedQuery');
      $ss = new Google_Service_AnalyticsReporting_Metric();
      $ss->setExpression('ga:sessions');
      $cv = new Google_Service_AnalyticsReporting_Metric();
      $cv->setExpression('ga:goalCompletionsAll');
      $cvr = new Google_Service_AnalyticsReporting_Metric();
      $cvr->setExpression('ga:goalConversionRateAll');
      $adCost = new Google_Service_AnalyticsReporting_Metric();
      $adCost->setExpression('ga:adCost');
      $adClicks = new Google_Service_AnalyticsReporting_Metric();
      $adClicks->setExpression('ga:adClicks');
      // $goalValue = new Google_Service_AnalyticsReporting_Metric();
      // $goalValue->setExpression('ga:goalValueAll');
      $orderBy = new Google_Service_AnalyticsReporting_OrderBy();
      $orderBy->setFieldName('ga:adClicks');
      $orderBy->setSortOrder('DESCENDING');
      $request = new Google_Service_AnalyticsReporting_ReportRequest();
      $request->setViewId($VIEW_ID);
      $request->setDateRanges(array($dateRange,$dateRangeTwo));
      $request->setMetrics(array($adCost, $adClicks, $cv));
      $requestTwo = new Google_Service_AnalyticsReporting_ReportRequest();
      $requestTwo->setViewId($VIEW_ID);
      $requestTwo->setDateRanges(array($dateRange, $dateRangeTwo));
      $requestTwo->setDimensions($query);
      $requestTwo->setMetrics(array($adClicks,$adCost,$ss,$cv,$cvr));
      $requestTwo->setOrderBys($orderBy);
      $requestTwo->setPageSize('10');
      $body = new Google_Service_AnalyticsReporting_GetReportsRequest();
      $body->setReportRequests(array($request, $requestTwo));
      $result = $analytics->reports->batchGet($body);
      $result = $analytics->reports->batchGet($body)->reports[0]->data->totals;
      $resultTwo = $analytics->reports->batchGet($body)->reports[1]->data->rows;
      $array = [];
      foreach ($result as $value) {
        $value = $value->values;
        array_push($array, $value);
      }
      foreach ($resultTwo as $key => $report) {
        $number[$key][0][] = [$report->dimensions,$report->metrics[0]->values[0],$report->metrics[0]->values[1],$report->metrics[0]->values[2],$report->metrics[0]->values[3],$report->metrics[0]->values[4]];
        $number[$key][1][]= [$report->dimensions,$report->metrics[1]->values[0],$report->metrics[1]->values[1],$report->metrics[1]->values[2],$report->metrics[1]->values[3],$report->metrics[1]->values[4]];
      }
      return [$array, $number];
  }

}
