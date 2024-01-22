$(function() {

	var curYear = moment().format('YYYY');
var curMonth = moment().format('MM');
// Calendar Event Source
var sptCalendarEvents = {
	id: 1,
	events: [{
		id: '1',
		start: curYear + '-' + curMonth + '-08T08:30:00',
		end: curYear + '-' + curMonth + '-08T13:00:00',
		title: 'BootstrapDash Meetup',
		backgroundColor: '#bff2f2',
		borderColor: '#00cccc',
		textColor: '#00cccc',
		description: 'In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis az pede mollis...'
	}, {
		id: '2',
		start: curYear + '-' + curMonth + '-10T09:00:00',
		end: curYear + '-' + curMonth + '-10T17:00:00',
		title: 'Design Review',
		backgroundColor: '#e0e4f4',
		borderColor: '#0a2ba5',
		textColor: '#0a2ba5',
		description: 'In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis az pede mollis...'
	}, {
		id: '3',
		start: curYear + '-' + curMonth + '-13T12:00:00',
		end: curYear + '-' + curMonth + '-13T18:00:00',
		title: 'Lifestyle Conference',
		backgroundColor: '#ffd5cc',
		borderColor: '#ff5733',
		textColor: '#ff5733',
		description: 'Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi...'
	}, {
		id: '4',
		start: curYear + '-' + curMonth + '-15T07:30:00',
		end: curYear + '-' + curMonth + '-15T15:30:00',
		title: 'Team Weekly Brownbag',
		backgroundColor: '#d2e0ff',
		borderColor: '#0373f3',
		textColor: '#0373f3',
		description: 'In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis az pede mollis...'
	}, {
		id: '5',
		start: curYear + '-' + curMonth + '-17T10:00:00',
		end: curYear + '-' + curMonth + '-19T15:00:00',
		title: 'Music Festival',
		backgroundColor: '#bfdeff',
		borderColor: '#007bff',
		textColor: '#007bff',
		description: 'In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis az pede mollis...'
	}, {
		id: '6',
		start: curYear + '-' + curMonth + '-08T13:00:00',
		end: curYear + '-' + curMonth + '-08T18:30:00',
		title: 'Attend Lea\'s Wedding',
		backgroundColor: '#d5c2f3',
		borderColor: '#560bd0',
		textColor: '#560bd0',
		description: 'In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis az pede mollis...'
	}]
};
// Birthday Events Source
var sptBirthdayEvents = {
	id: 2,
	backgroundColor: '#cbfbb0',
	borderColor: '#3bb001',
	textColor: '#3bb001',
	events: [{
		id: '7',
		start: curYear + '-' + curMonth + '-01T18:00:00',
		end: curYear + '-' + curMonth + '-01T23:30:00',
		title: 'Socrates Birthday',
		backgroundColor: '#d8fed1',
		borderColor: '#23bf08',
		description: 'In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis az pede mollis...'
	}, {
		id: '8',
		start: curYear + '-' + curMonth + '-21T15:00:00',
		end: curYear + '-' + curMonth + '-21T21:00:00',
		title: 'Reynante\'s Birthday',
		description: 'In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis az pede mollis...'
	}, {
		id: '9',
		start: curYear + '-' + curMonth + '-23T15:00:00',
		end: curYear + '-' + curMonth + '-23T21:00:00',
		title: 'Pauline\'s Birthday',
		description: 'In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis az pede mollis...'
	}]
};
var sptHolidayEvents = {
	id: 3,
	backgroundColor: '#fbbfdc',
	borderColor: '#f10075',
	textColor: '#f10075',
	events: [{
		id: '10',
		start: curYear + '-' + curMonth + '-04',
		end: curYear + '-' + curMonth + '-06',
		title: 'Feast Day'
	}, {
		id: '11',
		start: curYear + '-' + curMonth + '-26',
		end: curYear + '-' + curMonth + '-27',
		title: 'Memorial Day'
	}, {
		id: '12',
		start: curYear + '-' + curMonth + '-28',
		end: curYear + '-' + curMonth + '-29',
		title: 'Veteran\'s Day'
	}]
};
var sptOtherEvents = {
	id: 4,
	backgroundColor: '#ffecca',
	borderColor: '#ffb52b',
	textColor: '#ffb52b',
	events: [{
		id: '13',
		start: curYear + '-' + curMonth + '-06',
		end: curYear + '-' + curMonth + '-08',
		title: 'My Rest Day'
	}, {
		id: '13',
		start: curYear + '-' + curMonth + '-29',
		end: curYear + '-' + curMonth + '-31',
		title: 'My Rest Day'
	}]
};
	// Datepicker found in left sidebar of the page
var highlightedDays = ['2021-1-10', '2021-1-11', '2021-1-12', '2021-1-13', '2021-1-14', '2021-1-15', '2021-1-16'];
var date = new Date();

var generateTime = function(element) {
	var n = 0,
		min = 30,
		periods = [' AM', ' PM'],
		times = [],
		hours = [12, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11];
	for (var i = 0; i < hours.length; i++) {
		times.push(hours[i] + ':' + n + n + periods[0]);
		while (n < 60 - min) {
			times.push(hours[i] + ':' + ((n += min) < 10 ? 'O' + n : n) + periods[0])
		}
		n = 0;
	}
	times = times.concat(times.slice(0).map(function(time) {
		return time.replace(periods[0], periods[1])
	}));
	//console.log(times);
	$.each(times, function(index, val) {
		$(element).append('<option value="' + val + '">' + val + '</option>');
	});
}
generateTime('.main-event-time');

	$('#calendar').fullCalendar({
	  header: {
		left: 'prev,next today',
		center: 'title',
		right: 'month,agendaWeek,agendaDay'
	  },
	  
	  contentHeight: 480,
	  firstDay: 1,
	  defaultView: 'month',
	
	  allDayText: 'All Day',
	  views: {
		agenda: {
			columnHeaderHtml: function(mom) {
				return '<span>' + mom.format('ddd') + '</span>' + '<span>' + mom.format('DD') + '</span>';
			}
		},
		day: {
			columnHeader: false
		},
		listMonth: {
			listDayFormat: 'ddd DD',
			listDayAltFormat: false
		},
		listWeek: {
			listDayFormat: 'ddd DD',
			listDayAltFormat: false
		},
		agendaThreeDay: {
			type: 'agenda',
			duration: {
				days: 3
			},
			titleFormat: 'MMMM YYYY'
		}
	},
	eventSources: [sptCalendarEvents, sptBirthdayEvents, sptHolidayEvents, sptOtherEvents],
	eventAfterAllRender: function(view) {
		if (view.name === 'listMonth' || view.name === 'listWeek') {
			var dates = view.el.find('.fc-list-heading-main');
			dates.each(function() {
				var text = $(this).text().split(' ');
				var now = moment().format('DD');
				$(this).html(text[0] + '<span>' + text[1] + '</span>');
				if (now === text[1]) {
					$(this).addClass('now');
				}
			});
		}
	},
	eventRender: function(event, element) {
		if (event.description) {
			element.find('.fc-list-item-title').append('<span class="fc-desc">' + event.description + '</span>');
			element.find('.fc-content').append('<span class="fc-desc">' + event.description + '</span>');
		}
		var eBorderColor = (event.source.borderColor) ? event.source.borderColor : event.borderColor;
		element.find('.fc-list-item-time').css({
			color: eBorderColor,
			borderColor: eBorderColor
		});
		element.find('.fc-list-item-title').css({
			borderColor: eBorderColor
		});
		element.css('borderLeftColor', eBorderColor);
	},
	});
	var azCalendar = $('#calendar').fullCalendar('getCalendar');
// change view to week when in tablet
if (window.matchMedia('(min-width: 576px)').matches) {
	azCalendar.changeView('month');
}
// change view to month when in desktop
if (window.matchMedia('(min-width: 992px)').matches) {
	azCalendar.changeView('month');
}
// change view based in viewport width when resize is detected
azCalendar.option('windowResize', function(view) {
	if (view.name === 'listWeek') {
		if (window.matchMedia('(min-width: 992px)').matches) {
			azCalendar.changeView('month');
		} else {
			azCalendar.changeView('listWeek');
		}
	}
});
// display current date
var azDateNow = azCalendar.getDate();
azCalendar.option('select', function(startDate, endDate) {
	$('#modalSetSchedule').modal('show');
	$('#mainEventStartDate').val(startDate.format('LL'));
	$('#EventEndDate').val(endDate.format('LL'));
	$('#mainEventStartTime').val(startDate.format('LT')).trigger('change');
	$('#EventEndTime').val(endDate.format('LT')).trigger('change');
});
// Display calendar event modal
azCalendar.on('eventClick', function(calEvent, jsEvent, view) {
	var modal = $('#modalCalendarEvent');
	modal.modal('show');
	modal.find('.event-title').text(calEvent.title);
	if (calEvent.description) {
		modal.find('.event-desc').text(calEvent.description);
		modal.find('.event-desc').prev().removeClass('d-none');
	} else {
		modal.find('.event-desc').text('');
		modal.find('.event-desc').prev().addClass('d-none');
	}
	modal.find('.event-start-date').text(moment(calEvent.start).format('LLL'));
	modal.find('.event-end-date').text(moment(calEvent.end).format('LLL'));
	//styling
	modal.find('.modal-header').css('backgroundColor', (calEvent.source.borderColor) ? calEvent.source.borderColor : calEvent.borderColor);
});
// Enable/disable calendar events from displaying in calendar
$('.main-nav-calendar-event a').on('click', function(e) {
	e.preventDefault();
	if ($(this).hasClass('exclude')) {
		$(this).removeClass('exclude');
		$(this).is(':first-child') ? azCalendar.addEventSource(sptCalendarEvents) : '';
		$(this).is(':nth-child(2)') ? azCalendar.addEventSource(sptBirthdayEvents) : '';
		$(this).is(':nth-child(3)') ? azCalendar.addEventSource(sptHolidayEvents) : '';
		$(this).is(':nth-child(4)') ? azCalendar.addEventSource(sptOtherEvents) : '';
	} else {
		$(this).addClass('exclude');
		$(this).is(':first-child') ? azCalendar.removeEventSource(1) : '';
		$(this).is(':nth-child(2)') ? azCalendar.removeEventSource(2) : '';
		$(this).is(':nth-child(3)') ? azCalendar.removeEventSource(3) : '';
		$(this).is(':nth-child(4)') ? azCalendar.removeEventSource(4) : '';
	}
	azCalendar.render();
	if (window.matchMedia('(max-width: 575px)').matches) {
		$('body').removeClass('main-content-left-show');
	}
});
	
})