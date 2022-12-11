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

    events: [],

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
