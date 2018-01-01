<?php


namespace Laralibs\Helpers;

use Carbon\Carbon;


class CalendarService
{

    private $collections;
    private $args;
    protected $events = [];

    public function __construct($collections, $args = array())
    {

        $this->collections = $collections;
        $this->args = $args;
    }


    public function create($callback = null)
    {

        foreach ($this->collections as $collection) {

            $event = [
                $this->args["model"]     =>  $collection,
                "start"     => Carbon::parse($collection->{$this->args["base_period"]})->toDateString(),
                "end"       => Carbon::parse($collection->{$this->args["base_period"]})->addDays($this->args["grace_period"])->toDateString(),
                "title"     => isset($this->args["title"]) ? $this->args["title"] : "Title",
                "canRenew"  => true
            ];

            if (!is_null($callback)) {
                $callback($collection, $event);
            }

            array_push($this->events, $event);
        }
    }

    public function getEvents()
    {

        return $this->events;
    }
}