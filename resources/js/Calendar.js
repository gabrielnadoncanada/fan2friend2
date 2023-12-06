import {Calendar} from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import rrulePlugin from '@fullcalendar/rrule'
import frLocale from '@fullcalendar/core/locales/fr';
import interactionPlugin from '@fullcalendar/interaction';

document.addEventListener('DOMContentLoaded', function () {
    let calendarEl = document.getElementById('calendar');

    if (calendarEl) {
        let args = {
            timeZone: 'America/Toronto',
            plugins: [dayGridPlugin, interactionPlugin, rrulePlugin],
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev',
                center: 'title',
                right: 'next'
            },
            contentHeight: 'auto',
            events: window.availabilities,
            showNonCurrentDates: false,
            eventContent: function (arg) {
                return arg.event.startStr.slice(-2);
            },
            eventClick: function (info) {
                let intervals = displayEventsForEventDate(info.event, calendar);
                if (intervals) {
                    if (currentSelectedDay) {
                        currentSelectedDay.classList.remove('selected-day');
                        currentSelectedDay.style.color = '';
                    }
                    currentSelectedDay = info.el.closest('.fc-daygrid-day');
                    currentSelectedDay.classList.add('selected-day');

                    Livewire.dispatch('setSelectedDate', [
                        info.event.start,
                        intervals
                    ]);
                }
            },
        };
        if ( document.querySelector('html').lang === 'fr') {
            args.locales = [frLocale]
        }
        let currentSelectedDay = null;
        let calendar = new Calendar(calendarEl, args);
        calendar.render();
    }

    function displayEventsForEventDate(clickedEvent, calendar) {
        var events = calendar.getEvents();

        var clickedDate = clickedEvent.start;

        var filteredEvents = events.filter(event => {
            var eventDate = event.start;
            return eventDate.getDate() === clickedDate.getDate() &&
                eventDate.getMonth() === clickedDate.getMonth() &&
                eventDate.getFullYear() === clickedDate.getFullYear();
        });

        if (filteredEvents.length > 0) {
            let intervals = [];
            filteredEvents.forEach(event => {
                intervals.push({
                    'interval_id': event._def.extendedProps.interval_id,
                    'start_time': event._def.extendedProps.start_time,
                    'end_time': event._def.extendedProps.end_time,
                });
            });
            return intervals;
        } else {
            return false;
        }
    }
});
