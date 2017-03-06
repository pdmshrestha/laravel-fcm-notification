<?php

namespace Benwilkins\FCM;

/**
 * Class FcmMessage
 * @package Benwilkins\FCM
 */
class FcmMessage
{
    const PRIORITY_NORMAL = 'normal';
    const PRIORITY_HIGH = 'high';

    /**
    *@var array
    */
    private $toGroup;
    /**
     * @var string
     */
    private $to;
    /**
     * @var array
     */
    private $notification;
    /**
     * @var array
     */
    private $data;
    /**
     * @var string normal|high
     */
    private $priority = self::PRIORITY_NORMAL;


    /**
     * 
     * @param array $registration_ids
     * @return @this->
     */
    public function toGroup($reg_ids)
    {
        $this->toGroup = $reg_ids;
        return $this;
    }

    /**
     * @param string $recipient
     * @param bool $recipientIsTopic
     * @return $this
     */
    public function to($recipient, $recipientIsTopic = false)
    {
        if ($recipientIsTopic) {
            $this->to = '/topics/' . $recipient;
        } else {
            $this->to = $recipient;
        }

        return $this;
    }

    /**
     * @return string|null
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * The notification object to send to FCM. `title` and `body` are required.
     * @param array $params ['title' => '', 'body' => '', 'sound' => '', 'icon' => '', 'click_action' => '']
     * @return $this
     */
    public function content(array $params)
    {
        $this->notification = $params;

        return $this;
    }

    /**
     * @param array|null $data
     * @return $this
     */
    public function data($data = null)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @param string $priority
     * @return $this
     */
    public function priority($priority)
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * @return string
     */
    public function formatData()
    {
        $data = array(
            'data'         => $this->data,
            'notification' => $this->notification,
            'priority'     => $this->priority
        );

        if($this->toGroup != null){
            $data['registration_ids'] = $this->toGroup;
        } 
        else {
            $data['to'] = $this->to;
        }

        return json_encode($data);
    }
}