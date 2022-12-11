<template layout="default">
    <div>OwnTimetable page</div>
    <button
        class="text-lg bg-gray-50 px-3 py-2 border-4 border-blue-700 rounded-md"
        @click="test"
    >
        RUN
    </button>

    <div>
      <FullCalendar :options="options" />
    </div>

</template>

<script setup lang="ts">
  import { reactive } from 'vue';
  import '@fullcalendar/core/vdom';
  import FullCalendar from '@fullcalendar/vue3';
  import dayGridPlugin from '@fullcalendar/daygrid';
  import timeGridPlugin from '@fullcalendar/timegrid';
  import listPlugin from '@fullcalendar/list';
  import intercationPlugin from '@fullcalendar/interaction';

  const options = reactive({
    plugins: [dayGridPlugin, timeGridPlugin, listPlugin, intercationPlugin],
    initialView: 'timeGridWeek',
    locale: "de",
    firstDay: 1,

    slotLabelFormat: {
      hour12: false,
      hour: '2-digit',
      minute: '2-digit'
    },

    headerToolbar: {
      left: 'prev,next,today',
      center: 'title',
      right: 'timeGridDay,timeGridWeek,dayGridMonth'
    },

    events: [
      // Pausenzeiten
      {
        daysOfWeek: [ '1', '2', '3', '4', '5' ],
        startTime: '09:00:00',
        endTime: '09:20:00',
        display: 'background',
        color: 'gray',
      },
      {
        daysOfWeek: [ '1', '2', '3', '4', '5' ],
        startTime: '10:50:00',
        endTime: '11:10:00',
        display: 'background',
        color: 'gray',
      },
      {
        daysOfWeek: [ '1', '2', '3', '4', '5' ],
        startTime: '12:40:00',
        endTime: '13:20:00',
        display: 'background',
        color: 'gray',
      },
      {
        daysOfWeek: [ '1', '2', '3', '4', '5' ],
        startTime: '14:50:00',
        endTime: '15:10:00',
        display: 'background',
        color: 'gray',
      },
      {
        daysOfWeek: [ '1', '2', '3', '4', '5' ],
        startTime: '16:40:00',
        endTime: '17:00:00',
        display: 'background',
        color: 'gray',
      },
      {
        daysOfWeek: [ '1', '2', '3', '4', '5' ],
        startTime: '18:30:00',
        endTime: '18:40:00',
        display: 'background',
        color: 'gray',
      },
      {
        daysOfWeek: [ '1', '2', '3', '4', '5' ],
        startTime: '20:10:00',
        endTime: '20:20:00',
        display: 'background',
        color: 'gray',
      },
      // Standard Module
      {
        daysOfWeek: [ '2' ],
        title: 'Gremien-Blockzeit',

        startTime: oddWeek() ? '18:40:00' : '15:10:00',
        endTime: '20:50:00',
        allDay: false,
        color: 'gray',
      },
      // Module
      {
        title: 'Mathematik I',
        color: getEventColor('Uebung'),

        daysOfWeek: [ '1' ],
        startTime: '7:30:00',
        endTime: '9:00:00',
        allDay: false,

        extendedProps: {
          department: 'Mathematik',
          lecturer: 'Prof. Schwarzenberger'
        },
        description: 'Lecture'
      },
      {
        title: 'Mathematik I',
        color: getEventColor('Praktikum'),

        daysOfWeek: [ '1' ],
        startTime: '9:20:00',
        endTime: '10:50:00',
        allDay: false,

        extendedProps: {
          department: 'Mathematik',
          lecturer: 'Prof. Schwarzenberger'
        },
        description: 'Lecture'
      },
      {
        title: 'Wichtige Vorlesung',
        color: getEventColor('Vorlesung'),

        daysOfWeek: [ '3' ],
        startTime: '9:20:00',
        endTime: '16:40:00',
        allDay: false,

        extendedProps: {
          department: 'Mathematik',
          lecturer: 'Prof. Schwarzenberger'
        },
        description: 'Lecture'
      },
      {
        title: 'Weniger Wichtige Übung',
        color: getEventColor('Uebung'),

        daysOfWeek: [ '3' ],
        startTime: '11:10:00',
        endTime: '16:40:00',
        allDay: false,

        extendedProps: {
          department: 'Mathematik',
          lecturer: 'Prof. Schwarzenberger'
        },
        description: 'Lecture'
      },
      {
        title: 'Mathematik II',
        color: getEventColor('Vorlesung'),

        daysOfWeek: [ '1' ],
        startTime: '7:30:00',
        endTime: '9:00:00',
        allDay: false,

        extendedProps: {
          department: 'Mathematik',
          lecturer: 'Prof. Schwarzenberger'
        },
        description: 'Lecture'
      },
      {
        title: 'Wichtiger Termin',
        color: getEventColor('Termin'),

        daysOfWeek: [ '2' ],
        allDay: true
      },
      {
        title: 'Wichtiger Termin über 2 Tage',
        color: getEventColor('Termin'),

        start: '2022-12-15',
        end: '2022-12-17',
        allDay: true
      }
    ],

    eventClick: function(info) {
      alert('Event: ' + info.event.title);
    }
  });

  function oddWeek() {
    var currentDate = new Date();
    var startDate = new Date(currentDate.getFullYear(), 0, 1);
    var days = (currentDate - startDate) / (24 * 60 * 60 * 1000);
    return (Math.floor(days / 7) % 2) == 1;
  };

  function getEventColor(type) {
    return ({
      Vorlesung: 'orange',
      Praktikum: 'light-blue',
      Uebung: 'green',
      Termin: 'blue'
    }[type]);
  };

</script>
