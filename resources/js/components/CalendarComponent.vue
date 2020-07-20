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
                events: routeEvents('routeEventIndex'),
            },
            currentEvents: []
        }
    },

    methods: {
        onEventDrop(element) {
            alert('drop');
        },
        onEventClick(element) {
            console.log(element);
            /* clearMessages('#message');
            resetForm('#update');

            $("#modalUpdate").modal('show');
            $("#modalUpdate #titleModal").text('Alterar Evento');
            $("#modalUpdate buttom.deleteEvent").css('display', 'flex');

            let cli_id = element.event.extendedProps.cli_id;
            $("#modalUpdate select[name='cli_id']").val(cli_id);

            let tatu_id = element.event.extendedProps.tatu_id;
            $("#modalUpdate select[name='tatu_id']").val(tatu_id);

            let title = element.event.title;
            $("#modalUpdate input[name='title']").val(title);

            let start = moment(element.event.start).format("YYYY-MM-DD\THH:mm:ss");
            $("#modalUpdate input[name='start']").val(start);

            let end = moment(element.event.end).format("YYYY-MM-DD\THH:mm:ss");
            $("#modalUpdate input[name='end']").val(end); */

            /* let color = element.event.backgroundColor;
            $("#modalUpdate input[name='color']").val(color); */

            /* let note = element.event.extendedProps.note;
            $("#modalUpdate textarea[name='note']").val(note); */
        },
        onEventResize(element) {
            alert('dResizerop');
        },
        onSelect(element) {
            console.log(element);
            clearMessages('#message');
            resetForm('#attendanceForm');
            $("#attendance").modal('show');
            $("#attendance #titleModal").text('Adicionar Atendimento');
            $("#attendance #client").text($("#client_id option:selected").text());
            $("#attendance #collaborator").text($("#collaborator_id option:selected").text());
            $("#attendance button.deleteEvent").css('display', 'none');

            let client_id = $("#client_id option:selected").val();
            $("#attendance input[name='client_id']").val(client_id);

            let collaborator_id = $("#collaborator_id option:selected").val();
            $("#attendance input[name='collaborator_id']").val(collaborator_id);

            let title = $("#collaborator_id option:selected").text();
            $("#attendance input[name='title']").val(title);

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
