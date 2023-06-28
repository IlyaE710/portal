<?php

use yii2fullcalendar\yii2fullcalendar;
use yii\helpers\Url;

$this->title = 'Календарь с мероприятиями';
\app\assets\CalendarAsset::register($this);

?>

<div id="calendar"></div>
<div class="row my-4">
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const calendarEl = document.getElementById('calendar');
        const calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            firstDay: 1,
            locale: 'ru',
            height: 800,
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                // right: 'dayGridMonth,timeGridWeek,timeGridDay listWeek'
                right: 'dayGridMonth, listWeek'
            },
            buttonText: {
                today: 'Сегодня',
                day: 'День',
                week:'Неделя',
                month:'Месяц',
                list:'Список',
                days:'Список',
            },
            events: '<?= Url::to(['site/events']) ?>',
        });
        calendar.render();
    });
</script>
</div>