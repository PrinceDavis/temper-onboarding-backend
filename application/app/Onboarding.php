<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Onboarding extends Model
{

  public $timestamps  = false;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  private $content = [];
 

  function __construct() {
    //data cleanup
    $file = Storage::disk('local')->get('onboarding.csv');
    $string_content = str_replace(PHP_EOL, '', $file);
    $this->content = array_slice(explode("\r", $string_content), 1);

    //extract date information from data
    $first_user_data = explode(",", $this->content[0]);
    $this->begining_of_week1 = $first_user_data[4];
    $this->end_of_week1 = date('m/d/Y', strtotime($this->begining_of_week1 . ' + 6 days'));
    $this->begining_of_week2 = date('m/d/Y', strtotime($this->end_of_week1 . ' + 1 days'));
    $this->end_of_week2 = date('m/d/Y', strtotime($this->begining_of_week2 . ' + 6 days'));
    $this->begining_of_week3 = date('m/d/Y', strtotime($this->end_of_week2 . ' + 1 days'));
    $this->end_of_week3 = date('m/d/Y', strtotime($this->begining_of_week3 . ' + 6 days'));
    $this->begining_of_week4 = date('m/d/Y', strtotime($this->end_of_week3 . ' + 1 days'));
    $this->end_of_week4 = date('m/d/Y', strtotime($this->begining_of_week4 . ' + 6 days'));
  }

  /**
   * get stage of each user in week1 cohort
   * @return @var array
   */
  public  function getWeekOneCohort() {
    $cohort = $this
      ->findCohortBetween($this->begining_of_week1, $this->end_of_week1, $this->content);
    $aggregate = $this->aggregateByStage($this->extractCurrentStage($cohort));
    return $this->calculatePercentage(count($cohort), $aggregate);
  }

  /**
   * get stage of each user in week2 cohort
   * @return @var array
   */
  public function getWeekTwoCohort()
  {
    $cohort = $this
      ->findCohortBetween($this->begining_of_week2, $this->end_of_week2, $this->content);
    $aggregate = $this->aggregateByStage($this->extractCurrentStage($cohort));
    return $this->calculatePercentage(count($cohort), $aggregate);;
  }

  /**
   * get stage of each user in week3 cohort
   * @return @var array
   */
  public function getWeekThreeCohort()
  {
    $cohort = $this
      ->findCohortBetween($this->begining_of_week3, $this->end_of_week3, $this->content);
    $aggregate = $this->aggregateByStage($this->extractCurrentStage($cohort));
    return $this->calculatePercentage(count($cohort), $aggregate);
  }

  /**
   * get stage of each user in week4 cohort
   * @return @var array
   */
  public function getWeekFourCohort()
  {
    $cohort = $this
      ->findCohortBetween($this->begining_of_week4, $this->end_of_week4, $this->content);
    $aggregate = $this->aggregateByStage($this->extractCurrentStage($cohort));
    return $this->calculatePercentage(count($cohort), $aggregate);
  }

  /**
   * return record between two dates
   * @param  $string $begining_at 
   * @param  $string $end_at
   * @param  array  $array 
   * @return @var array
   */
  private function findCohortBetween($begining_at, $end_at, $array = []) {
    return array_filter($array, function($item) use ($begining_at, $end_at, $array) {
      $record = explode(",", $item);
      $record_date = strtotime($record[4]);
      if($record_date>= strtotime($begining_at) && $record_date <= strtotime($end_at)){
        return true;
      }
      return false;
    });
  }

  /**
   * return the stage each user in the cohort is in
   * @return @var array
   */
  private function extractCurrentStage($array = [])
  {
    return array_map(function($item){
      return explode(",", $item)[1];
    }, $array);
  }

  /**
   * get the sum of user on a state
   * @param  array  $array
   * @return array
   */
  private function aggregateByStage($array = [])
  {
    $aff = 0;
    $aggregate = [];
    foreach ($array as $item) {
      if(array_key_exists($item, $aggregate)) {
        $aggregate[$item] = $aggregate[$item] + 1;
        continue;
      }
      $aggregate[$item] = 1;
    }
    return array_values($aggregate);
  }

  /**
   * return the percentage of each element
   * @param number $whole 
   * @param  array  $elements
   * @return array 
   */
  private function calculatePercentage($whole, $elements = [])
  {
    return array_map(function ($item) use($whole) {
      return ceil(($item / $whole) * 100);
    }, $elements);
  }
}
