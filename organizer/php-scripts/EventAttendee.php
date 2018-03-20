<?php
/**
 * Created by PhpStorm.
 * User: Trosalio
 * Date: 3/12/2018
 * Time: 1:02 AM
 */

class EventAttendee
{
    private $attendeeID;
    private $attendeeName;
    private $flag;
    private $email;
    private $paymentID;
    private $qrCode;
    private $evidence;
    private $registerStamp;

    /**
     * EventAttendee constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return mixed
     */
    public function getAttendeeID()
    {
        return $this->attendeeID;
    }

    /**
     * @param mixed $attendeeID
     */
    public function setAttendeeID($attendeeID): void
    {
        $this->attendeeID = $attendeeID;
    }

    /**
     * @return mixed
     */
    public function getAttendeeName()
    {
        return $this->attendeeName;
    }

    /**
     * @param mixed $attendeeName
     */
    public function setAttendeeName($attendeeName): void
    {
        $this->attendeeName = $attendeeName;
    }


    /**
     * @return mixed
     */
    public function getFlag()
    {
        return $this->flag;
    }

    /**
     * @param mixed $flag
     */
    public function setFlag($flag): void
    {
        $this->flag = $flag;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPaymentID()
    {
        return $this->paymentID;
    }

    /**
     * @param mixed $paymentID
     */
    public function setPaymentID($paymentID): void
    {
        $this->paymentID = $paymentID;
    }

    /**
     * @return mixed
     */
    public function getQrCode()
    {
        return $this->qrCode;
    }

    /**
     * @param mixed $qrCode
     */
    public function setQrCode($qrCode): void
    {
        $this->qrCode = $qrCode;
    }

    /**
     * @return mixed
     */
    public function getEvidence()
    {
        return $this->evidence;
    }

    /**
     * @param mixed $evidence
     */
    public function setEvidence($evidence): void
    {
        $this->evidence = $evidence;
    }

    /**
     * @return mixed
     */

    public function getRegisterStamp()
    {
        return $this->registerStamp;
    }

    /**
     * @param mixed $registerStamp
     */
    public function setRegisterStamp($registerStamp): void
    {
        $this->registerStamp = $registerStamp;
    }

    public function getPaymentStatus()
    {
        return ($this->flag) ? "Approved " : "Pending";
    }

    public function getEvidenceLink()
    {
        $link = "assets/payment/" . $this->evidence;
        return "<img src=\"$link\" style=\"height: 100%; width: 100%\">$this->evidence</img>";
    }

}