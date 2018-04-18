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
    const MIN_LENGTH = 3;
    const MAX_LENGTH = 20;
    public $form = [
        'eventno'   =>    [
            'type'    =>    VAR_TYPE_STRING,
            'required'    =>    'true',
        ],
        'title'   =>    [
            'name'    =>    'タイトル',
            'type'    =>    VAR_TYPE_STRING,
            'form_type'   =>    FORM_TYPE_TEXT,
            'required'    =>    'true',
            'min'   =>    self::MIN_LENGTH,
            'max'   =>    self::MAX_LENGTH,
        ],
        'release_date'    =>    [
            'name'    =>    '公開開始日',
            'type'    =>    VAR_TYPE_DATE,
            'required'    =>    'true',
        ],
        'end_date'    =>    [
            'name'    =>    '公開終了日',
            'type'    =>    VAR_TYPE_DATE,
            'required'    =>    'true',
        ],
        'picture_array'   =>    [
            'name'    =>    '写真',
            'type'    =>    [VAR_TYPE_FILE],
            'form_type'   =>    FORM_TYPE_FILE, FORM_TYPE_SELECT,
            'required'    =>    'true',
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
        //  フォームに初期値が設定されていない時は、エラーメッセージを表示しない
        if ($this->af->form['title']['default'] === null && $this->af->form['release_date']['default'] === null
            && $this->af->form['end_date']['default'] === null) {
                return null;
            }

        if ($this->af->validate() > 0) {
          // forward to error view (this is sample)
              return 'edit';
          }
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

        //  存在しないイベントのURLが投げられたら一覧画面に返される
        if (!$eventId) {
            return 'show';
        }

        $this->session->set('edit', $eventArray[$eventId]);
        $this->session->start('edit');

        echo '<pre>';
                var_dump($this->session->get('edit'));
        echo '</pre>';

        return 'edit';
    }

    /**
     *  セッション切れの確認
     *
     *  @access public
     *  @return string  編集画面
     */
    public function authenticate()
    {
        if (!$this->session->isStart('login')) {
            return 'login';
        }

        if (!$this->session->isStart('show')) {
            return 'show';
        }
    }
}
