<?php
/**
 *  Edit.php
 *
 *  @author     {$author}
 *  @package    Sharepictures
 */

/**
 *  edit Form implementation.
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Sharepictures
 */
class Sharepictures_Form_Edit extends Sharepictures_ActionForm
{
    /**
     *  @access protected
     *  @var    array   form definition.
     */
    public $form = [
        'eventno'   =>    [
            'type'    =>    VAR_TYPE_INT,
            'required'    => true,
        ],
    ];
}

/**
 *  edit action implementation.
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Sharepictures
 */
class Sharepictures_Action_Edit extends Sharepictures_ActionClass
{
    /**
     *  preprocess of edit Action.
     *
     *  @access public
     *  @return string    forward name(null: success.
     *                                false: in case you want to exit.)
     */
    public function prepare()
    {
        return null;
    }

    /**
     *  edit action implementation.
     *
     *  @access public
     *  @return string  forward name.
     */
    public function perform()
    {
        $eventArray = $this->session->get('show');
        $eventId = array_search($this->af->get('eventno'), array_column($eventArray, 'id'));
        if ($eventId !== 0 && ! $eventId) {
            return 'show';
        }
        //   存在するイベントのURLならば、初期化処理に入る
        $this->session->set('edit', $eventArray[$eventId]);

        Ethna_Util::setCsrfID();
        return 'edit';
    }
}
