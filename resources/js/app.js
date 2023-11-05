window.onLivewireCalendarEventDragStart = function(event, eventId) {
    event.dataTransfer.setData('id', eventId);
};

window.onLivewireCalendarEventDragEnter = function(event, componentId, dateString, dragAndDropClasses) {
    event.stopPropagation();
    event.preventDefault();

    const element = document.getElementById(`${componentId}-${dateString}`);
    element.className = `${element.className} ${dragAndDropClasses}`;
};

window.onLivewireCalendarEventDragLeave = function(event, componentId, dateString, dragAndDropClasses) {
    event.stopPropagation();
    event.preventDefault();

    const element = document.getElementById(`${componentId}-${dateString}`);
    element.className = element.className.replace(dragAndDropClasses, '');
};

window.onLivewireCalendarEventDragOver = function(event) {
    event.stopPropagation();
    event.preventDefault();
};

window.onLivewireCalendarEventDrop = function(event, componentId, dateString, dragAndDropClasses) {
    event.stopPropagation();
    event.preventDefault();

    const element = document.getElementById(`${componentId}-${dateString}`);
    element.className = element.className.replace(dragAndDropClasses, '');

    window.Livewire
        .find(componentId)
        .call('onEventDropped', event.dataTransfer.getData('id'), dateString);
};
