<?php

class Event
{
    private $eventID;
    private $orgID;
    private $eventName;
    private $eventType;
    private $detail;
    private $createDate;
    private $registrableDate;
    private $startDate;
    private $endDate;
    private $age;
    private $gender;
    private $maxEntries;
    private $attendingCost;
    private $indoorName;
    private $location;
    private $surveyLink;
    private $thumbnail;
    private $attendees;

    /**
     * Event constructor.
     * @param $eventID
     * @param $orgID
     * @param $eventName
     * @param $eventType
     * @param $detail
     * @param $createDate
     * @param $registrableDate
     * @param $startDate
     * @param $endDate
     * @param $age
     * @param $gender
     * @param $maxEntries
     * @param $attendingCost
     * @param $indoorName
     * @param $location
     */
    public function __construct($eventID, $orgID, $eventName, $eventType, $detail,
                                $createDate, $registrableDate, $startDate, $endDate, $age,
                                $gender, $maxEntries, $attendingCost, $indoorName, $location)
    {
        $this->eventID = $eventID;
        $this->orgID = $orgID;
        $this->eventName = $eventName;
        $this->eventType = $eventType;
        $this->detail = $detail;
        $this->createDate = $createDate;
        $this->registrableDate = $registrableDate;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->age = $age;
        $this->gender = $gender;
        $this->maxEntries = $maxEntries;
        $this->attendingCost = $attendingCost;
        $this->indoorName = $indoorName;
        $this->location = $location;
        $this->attendees = [];
    }

    /**
     * @return mixed
     */
    public function getEventID()
    {
        return $this->eventID;
    }

    /**
     * @param mixed $eventID
     */
    public function setEventID($eventID): void
    {
        $this->eventID = $eventID;
    }

    /**
     * @return mixed
     */
    public function getOrgID()
    {
        return $this->orgID;
    }

    /**
     * @param mixed $orgID
     */
    public function setOrgID($orgID): void
    {
        $this->orgID = $orgID;
    }

    /**
     * @return mixed
     */
    public function getEventName()
    {
        return $this->eventName;
    }

    /**
     * @param mixed $eventName
     */
    public function setEventName($eventName): void
    {
        $this->eventName = $eventName;
    }

    /**
     * @return mixed
     */
    public function getEventType()
    {
        return $this->eventType;
    }

    /**
     * @param mixed $eventType
     */
    public function setEventType($eventType): void
    {
        $this->eventType = $eventType;
    }

    /**
     * @return mixed
     */
    public function getDetail()
    {
        return $this->detail;
    }

    /**
     * @param mixed $detail
     */
    public function setDetail($detail): void
    {
        $this->detail = $detail;
    }

    /**
     * @return mixed
     */
    public function getCreateDate()
    {
        return $this->createDate;
    }

    /**
     * @param mixed $createDate
     */
    public function setCreateDate($createDate): void
    {
        $this->createDate = $createDate;
    }

    /**
     * @return mixed
     */
    public function getRegistrableDate()
    {
        return $this->registrableDate;
    }

    /**
     * @param mixed $registrableDate
     */
    public function setRegistrableDate($registrableDate): void
    {
        $this->registrableDate = $registrableDate;
    }

    /**
     * @return mixed
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * @param mixed $startDate
     */
    public function setStartDate($startDate): void
    {
        $this->startDate = $startDate;
    }

    /**
     * @return mixed
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * @param mixed $endDate
     */
    public function setEndDate($endDate): void
    {
        $this->endDate = $endDate;
    }

    /**
     * @return mixed
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @param mixed $age
     */
    public function setAge($age): void
    {
        $this->age = $age;
    }

    /**
     * @return mixed
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param mixed $gender
     */
    public function setGender($gender): void
    {
        $this->gender = $gender;
    }

    /**
     * @return mixed
     */
    public function getMaxEntries()
    {
        return $this->maxEntries;
    }

    /**
     * @param mixed $maxEntries
     */
    public function setMaxEntries($maxEntries): void
    {
        $this->maxEntries = $maxEntries;
    }

    /**
     * @return mixed
     */
    public function getAttendingCost()
    {
        return $this->attendingCost;
    }

    /**
     * @param mixed $attendingCost
     */
    public function setAttendingCost($attendingCost): void
    {
        $this->attendingCost = $attendingCost;
    }

    /**
     * @return mixed
     */
    public function getIndoorName()
    {
        return $this->indoorName;
    }

    /**
     * @param mixed $indoorName
     */
    public function setIndoorName($indoorName): void
    {
        $this->indoorName = $indoorName;
    }

    /**
     * @return mixed
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param mixed $location
     */
    public function setLocation($location): void
    {
        $this->location = $location;
    }

    /**
     * @return mixed
     */
    public function getSurveyLink()
    {
        return ($this->surveyLink === null) ? "No Link Given" : "<a href=\"$this->surveyLink\">Survey Link</a>";
    }

    /**
     * @param mixed $surveyLink
     */
    public function setSurveyLink($surveyLink): void
    {
        $this->surveyLink = $surveyLink;
    }

    /**
     * @return mixed
     */
    public function getThumbnail()
    {
        return ($this->thumbnail === null) ? "holder-pic.png" : $this->thumbnail;
    }

    /**
     * @param mixed $thumbnail
     */
    public function setThumbnail($thumbnail): void
    {
        $this->thumbnail = $thumbnail;
    }

    /**
     * @return array
     */
    public function getAttendees(): array
    {
        return $this->attendees;
    }

    /**
     * @param array $attendees
     */
    public function setAttendees(array $attendees): void
    {
        $this->attendees = $attendees;
    }

    /**
     * @param array $attendee
     */
    public function pushAttendee($attendee): void
    {
        array_push($this->attendees, $attendee);
    }

    /**
     * @return string
     */
    public function getAgeCondition(): string
    {
        return ($this->age <= 0) ? "All Age" : "Must be above $this->age";
    }

    /**
     * @return string
     */
    public function getAttendingCostStr(): string
    {
        return ($this->attendingCost <= 0) ? "Free" : "$this->attendingCost ฿";
    }

    /**
     * @return string
     */
    public function getEntries(): string
    {
        $currentEntries = count($this->attendees);
        $remainEntries = ($this->maxEntries - $currentEntries);
        if ($remainEntries <= 0) {
            return "No available entry";
        } else {
            if ($remainEntries == 1) {
                return "$currentEntries/$this->maxEntries (Only $remainEntries Entry left!)";
            }
            return "$currentEntries/$this->maxEntries ($remainEntries Entries left)";
        }
    }

    /**
     * @return string
     */
    public function getGenderCondition(): string
    {
        switch ($this->gender) {
            case 'all':
                return 'All Gender';
            case 'female':
                return 'Female';
            case 'male':
                return 'Male';
            default:
                return "Shouldn't be executed this, some error occurs";
        }
    }

    /**
     * @return string
     */
    public function getLocationName(): string
    {
        return $this->indoorName . ' &raquo; ' . $this->location;
    }

    /**
     * @return string
     */
    public function getTypeStr(): string
    {
        switch ($this->eventType) {
            case 'Business':
                return 'Business';
            case 'Community':
                return 'Community';
            case 'Education':
                return 'Education';
            case 'Health':
                return 'Health';
            case 'Hobbies':
                return 'Hobbies';
            case 'Music':
                return 'Music';
            case 'Science':
                return htmlspecialchars('Science & Technology');
            case 'Sports':
                return 'Sports';

            default:
                return "Shouldn't be executed this, some error occurs";
        }
    }
}