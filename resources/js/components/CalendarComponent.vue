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

var route = routeEvents('routeScheduleIndex');
console.log(route);

export default {
    components: {
        FullCalendar // make the <FullCalendar> tag available
    },
    data: function () {
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
            console.log(element);
            clearMessages('#message');
            resetForm('#attendanceUpForm');
            $("#attendanceUp").modal('show');
            $("#attendanceUp #titleModal").text('Editar Atendimento Nº ' + element.event.extendedProps.attendance_id);
            $("#attendanceUp #client").text(element.event.extendedProps.client);
            $("#attendanceUp #collaborator").text(element.event.extendedProps.collaborator);
            $("#attendanceUp input[name='client_id']").val(element.event.extendedProps.client_id);
            $("#attendanceUp input[name='collaborator_id']").val(element.event.extendedProps.collaborator_id);
            $("#attendanceUp input[name='attendance_id']").val(element.event.extendedProps.attendance_id);
            $("#attendanceUp input[name='schedule_id']").val(element.event.id);
            $("#attendanceUp input[name='title']").val(element.event.title);

            let start = moment(element.event.start).format("YYYY-MM-DD\THH:mm:ss");
            $("#attendanceUp input[name='start']").val(start);

            let end = moment(element.event.end).format("YYYY-MM-DD\THH:mm:ss");
            $("#attendanceUp input[name='end']").val(end);
        },
        onEventClick(element) {
            console.log(element);
            clearMessages('#message');
            resetForm('#attendanceUpForm');
            $("#attendanceUp").modal('show');
            $("#attendanceUp #titleModal").text('Editar Atendimento Nº ' + element.event.extendedProps.attendance_id);
            $("#attendanceUp #client").text(element.event.extendedProps.client);
            $("#attendanceUp #collaborator").text(element.event.extendedProps.collaborator);
            $("#attendanceUp input[name='client_id']").val(element.event.extendedProps.client_id);
            $("#attendanceUp input[name='collaborator_id']").val(element.event.extendedProps.collaborator_id);
            $("#attendanceUp input[name='attendance_id']").val(element.event.extendedProps.attendance_id);
            $("#attendanceUp input[name='schedule_id']").val(element.event.id);
            $("#attendanceUp input[name='title']").val(element.event.title);

            let start = moment(element.event.start).format("YYYY-MM-DD\THH:mm:ss");
            $("#attendanceUp input[name='start']").val(start);

            let end = moment(element.event.end).format("YYYY-MM-DD\THH:mm:ss");
            $("#attendanceUp input[name='end']").val(end);
        },
        onEventResize(element) {
            console.log(element);
            clearMessages('#message');
            resetForm('#attendanceUpForm');
            $("#attendanceUp").modal('show');
            $("#attendanceUp #titleModal").text('Editar Atendimento Nº ' + element.event.extendedProps.attendance_id);
            $("#attendanceUp #client").text(element.event.extendedProps.client);
            $("#attendanceUp #collaborator").text(element.event.extendedProps.collaborator);
            $("#attendanceUp input[name='client_id']").val(element.event.extendedProps.client_id);
            $("#attendanceUp input[name='collaborator_id']").val(element.event.extendedProps.collaborator_id);
            $("#attendanceUp input[name='attendance_id']").val(element.event.extendedProps.attendance_id);
            $("#attendanceUp input[name='schedule_id']").val(element.event.id);
            $("#attendanceUp input[name='title']").val(element.event.title);

            let start = moment(element.event.start).format("YYYY-MM-DD\THH:mm:ss");
            $("#attendanceUp input[name='start']").val(start);

            let end = moment(element.event.end).format("YYYY-MM-DD\THH:mm:ss");
            $("#attendanceUp input[name='end']").val(end);
        },
        onSelect(element) {
            console.log(element);
            clearMessages('#message');
            resetForm('#attendanceForm');
            $("#attendance").modal('show');
            $("#attendance #titleModal").text('Adicionar Atendimento');

            let start = moment(element.start).format("YYYY-MM-DD\THH:mm:ss");
            $("#attendance input[name='start']").val(start);

            let end = moment(element.end).format("YYYY-MM-DD\THH:mm:ss");
            $("#attendance input[name='end']").val(end);
        },
    }
}
</script>

<template>
<FullCalendar :options="calendarOptions" />
</template>
