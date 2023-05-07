<?php

namespace app\widgets\sidebar;

class SidebarWidget extends \yii\base\Widget
{
    public array $items;
    public function run()
    {
        return $this->render('sidebar', ['items' => $this->items]);
    }

}