<?php

namespace App\util;

use Illuminate\Support\Facades\Log;


class GetHoliday{
    function getHoliday($year ,$month){
    
        //api 요청 정보(공휴일 정보)
        $key = "nWTuUPTKOjIdZDakR%2FUff%2F4Otqjll4bathvgyQ%2BOM50Wj4gIY8HU06d1I6VqXPkIF%2Fhg%2F0yFWiTkotWQPVT1kA%3D%3D";
        $data = 'ServiceKey='.$key;
        $data .= '&solYear='.$year;
        $data .= '&solMonth='.sprintf("%02d",$month);
    
    
       // api 요청 구현
        $url = "http://apis.data.go.kr/B090041/openapi/service/SpcdeInfoService/getHoliDeInfo?".$data;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        $response = curl_exec($ch);
        curl_close($ch);
    
        //json으로 변환
        $xml = simplexml_load_string($response, 'SimpleXMLElement', LIBXML_NOCDATA);
        $temp = json_decode(json_encode((array)$xml), TRUE);
        //필요한 정보 가공
        if( $temp["body"]["totalCount"]==0){
            return [];
        }
        $temp = $temp["body"]["items"]["item"];
        $holidayInfo = array();

        
        if(array_key_exists('locdate', $temp)&& $temp['isHoliday']=="Y"){// 달에 한번 공휴일 일경우
            $holidayInfo[0] = $temp['locdate'];
        }else if(array_key_exists('locdate', $temp) &&$temp['isHoliday']!="Y" ){  // 달에 한번 공휴일이 아니지만 국경일
            return;
        }else{
            for( $i = 0 ; $i < count($temp) ; $i++ ){  //공휴일이 2일 이상
                if($temp[$i]['isHoliday']=='Y'){
                    $holidayInfo[$i] = $temp[$i]['locdate'];
                }
            }
        }
        //ex ['20220909','20220910',...]
        return $holidayInfo;
    
    }
}

