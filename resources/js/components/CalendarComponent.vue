<script>
import FullCalendar from '@fullcalendar/vue'
import dayGridPlugin from '@fullcalendar/daygrid'
import interactionPlugin from '@fullcalendar/interaction'
import timeGridPlugin from '@fullcalendar/timegrid'
import allLocales from '@fullcalendar/core/locales-all';
import bootstrapPlugin from '@fullcalendar/bootstrap';
import {
    Calendar
} from '@fullcalendar/core';

var moment = require('moment');

function routeEvents(route) {
    return document.getElementById('app').dataset[route];
};

function resetForm(form) {
    $(form)[0].reset();
};

function clearMessages(element) {
    $(element).text('');
};

function update(element) {
    console.log(element);
    let start = moment(element.event.start).format("YYYY-MM-DD\THH:mm:ss");
    let end = moment(element.event.end).format("YYYY-MM-DD\THH:mm:ss");
    let curdate = moment(new Date()).format("YYYY-MM-DD\THH:mm:ss");
    if (curdate > start || curdate > end){
        alert('Não é possível criar um atendimento de forma retroativa');
        window.location.reload();
        return;
    }
    clearMessages('#message');
    resetForm('#attendanceUpForm');
    $("#attendanceUp").modal('show');
    $("#attendanceUp #titleModal").text('Editar Atendimento Nº ' + element.event.extendedProps.attendance_id);
    $("#attendanceUp #client").text(element.event.extendedProps.client);
    $("#attendanceUp #collaborator").text(element.event.extendedProps.collaborator);
    $("#attendanceUp #note").text(element.event.extendedProps.note);
    $("#attendanceUp input[name='client_id']").val(element.event.extendedProps.client_id);
    $("#attendanceUp input[name='collaborator_id']").val(element.event.extendedProps.collaborator_id);
    $("#attendanceUp input[name='attendance_id']").val(element.event.extendedProps.attendance_id);
    $("#attendanceUp input[name='schedule_id']").val(element.event.id);
    $("#attendanceUp input[name='title']").val(element.event.title);
    $("#attendanceUp input[name='start']").val(start);
    $("#attendanceUp input[name='end']").val(end);
}

export default {
    components: {
        FullCalendar // make the <FullCalendar> tag available
    },
    data: function () {
        var route = routeEvents('routeScheduleIndex');
        return {
            calendarOptions: {
                plugins: [
                    dayGridPlugin,
                    timeGridPlugin,
                    interactionPlugin, // needed for dateClick
                    bootstrapPlugin
                ],
                headerToolbar: {
                    left: 'today prev,next',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                initialView: 'timeGridWeek',
                locales: allLocales,
                locale: 'pt-br',
                slotDuration: '00:10:00',
                slotMinTime: '08:00:00',
                slotMaxTime: '22:00:00',
                navLinks: true,
                eventLimit: true,
                selectable: true,
                dayMaxEvents: true,
                editable: true,
                eventDrop: this.onEventDrop,
                eventClick: this.onEventClick,
                eventResize: this.onEventResize,
                select: this.onSelect,
                events: route,
            },
            currentEvents: []
        }
    },

    methods: {
        onEventDrop(element) {
            update(element);
        },
        onEventClick(element) {
            update(element);
        },
        onEventResize(element) {
            update(element);
        },
        onSelect(element) {
            console.log(element);
            let start = moment(element.start).format("YYYY-MM-DD\THH:mm:ss");
            let end = moment(element.end).format("YYYY-MM-DD\THH:mm:ss");
            let curdate = moment(new Date()).format("YYYY-MM-DD\THH:mm:ss");
            if (curdate > start || curdate > end){
                alert('Não é possível criar um atendimento de forma retroativa');
                window.location.reload();
                return;
            }
            clearMessages('#message');
            resetForm('#attendanceForm');
            $("#attendance").modal('show');
            $("#attendance #titleModal").text('Adicionar Atendimento');
            $("#attendance input[name='start']").val(start);
            $("#attendance input[name='end']").val(end);
        },
    }
}
</script>

<template>
<FullCalendar :options="calendarOptions" />
</template>
