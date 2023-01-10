<?php include('header.php'); ?>
	<div class="page-container">
		<div class="page-content">
			<?php include('top-box.php'); ?>

			 <div id="menu">
			 	<span class="dropdown">
          <button id="dropdownMenu-calendarType" class="btn btn-default btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown"
              aria-haspopup="true" aria-expanded="true">
	          <i id="calendarTypeIcon" class="calendar-icon ic_view_month" style="margin-right: 4px;"></i>
            <span id="calendarTypeName">Dropdown</span>&nbsp;
            <i class="calendar-icon tui-full-calendar-dropdown-arrow"></i>
          </button>
          <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu-calendarType">
            <li role="presentation">
              <a class="dropdown-menu-title" role="menuitem" data-action="toggle-daily">
                <i class="calendar-icon ic_view_day"></i>Diário
              </a>
            </li>
            <li role="presentation">
              <a class="dropdown-menu-title" role="menuitem" data-action="toggle-weekly">
                <i class="calendar-icon ic_view_week"></i>Semanal
              </a>
            </li>
            <li role="presentation">
              <a class="dropdown-menu-title" role="menuitem" data-action="toggle-monthly">
                <i class="calendar-icon ic_view_month"></i>Mensal
              </a>
            </li>
            <li role="presentation" class="dropdown-divider"></li>
            <li role="presentation">
              <a role="menuitem" data-action="toggle-workweek">
                <input type="checkbox" class="tui-full-calendar-checkbox-square" value="toggle-workweek" checked>
                <span class="checkbox-title"></span>Mostrar finais de semana
              </a>
            </li>
            <li role="presentation">
              <a role="menuitem" data-action="toggle-start-day-1">
                <input type="checkbox" class="tui-full-calendar-checkbox-square" value="toggle-start-day-1">
                <span class="checkbox-title"></span>Começar semana na segunda feira
              </a>
            </li>
            <li role="presentation">
              <a role="menuitem" data-action="toggle-narrow-weekend">
                <input type="checkbox" class="tui-full-calendar-checkbox-square" value="toggle-narrow-weekend">
                <span class="checkbox-title"></span>Narrower than weekdays
              </a>
            </li>
          </ul>
        </span>
	      <span id="menu-navi">
	        <button type="button" class="btn btn-default btn-sm move-today" data-action="move-today">Hoje</button>
	        <button type="button" class="btn btn-default btn-sm move-day move-it" data-action="move-prev">
	          <i class="fa fa-chevron-left" data-action="move-prev"></i>
	        </button>
	        <button type="button" class="btn btn-default btn-sm move-day move-it" data-action="move-next">
	          <i class="fa fa-chevron-right" data-action="move-next"></i>
	        </button>
	      </span>
	      <span id="renderRange" class="render-range"></span>
	    </div>

	    <div id="calendar"></div>
		</div>

	</div>
</section>
<?php include('footer.php'); ?>

<?php /*

	Para salvar dados na agenda é este código abaixo. Ele inicia a partir da linha 421.
	
	{id: 489273, title: 'Workout for 2020-04-05', isAllDay: false, start: '2022-01-18T11:30:00+09:00', end: '2022-01-18T14:00:00+09:00', goingDuration: 30, comingDuration: 30, color: '#ffffff', isVisible: true, bgColor: '#69BB2D', dragBgColor: '#69BB2D', borderColor: '#69BB2D', calendarId: '1', category: 'allday', dueDateClass: '', customStyle: 'cursor: default;', isPending: false, isFocused: false, isReadOnly: false, isPrivate: false, location: '', attendees: '', recurrenceRule: '', state: ''},

	Vamos precisar também salvar dados a partir desta agenda, o plugin salva os dados da mesma forma acima, seria possível salvar estes dados através de uma requisição neste formato de json?

*/ ?>


<script>
	$(function() {
				
		  
	'use strict';

	var CalendarList = [];

	function CalendarInfo() {
	    this.id = null;
	    this.name = null;
	    this.checked = true;
	    this.color = null;
	    this.bgColor = null;
	    this.borderColor = null;
	    this.dragBgColor = null;
	}

	function addCalendar(calendar) {
	    CalendarList.push(calendar);
	}

	function findCalendar(id) {
	    var found;

	    CalendarList.forEach(function(calendar) {
	        if (calendar.id === id) {
	            found = calendar;
	        }
	    });

	    return found || CalendarList[0];
	}

	function hexToRGBA(hex) {
	    var radix = 16;
	    var r = parseInt(hex.slice(1, 3), radix),
	        g = parseInt(hex.slice(3, 5), radix),
	        b = parseInt(hex.slice(5, 7), radix),
	        a = parseInt(hex.slice(7, 9), radix) / 255 || 1;
	    var rgba = 'rgba(' + r + ', ' + g + ', ' + b + ', ' + a + ')';

	    return rgba;
	}

	(function() {
	    var calendar;
	    var id = 0;

	    calendar = new CalendarInfo();
	    id += 1;
	    calendar.id = String(id);
	    calendar.name = 'Post';
	    calendar.color = '#624AC0';
	    calendar.bgColor = '#F0EFF6';
	    calendar.dragBgColor = '#F0EFF6';
	    calendar.borderColor = '#F0EFF6';
	    addCalendar(calendar);

	    calendar = new CalendarInfo();
	    id += 1;
	    calendar.id = String(id);
	    calendar.name = 'Events';
	    calendar.color = '#FF8C1A';
	    calendar.bgColor = '#FDF8F3';
	    calendar.dragBgColor = '#FDF8F3';
	    calendar.borderColor = '#FDF8F3';
	    addCalendar(calendar);

	    calendar = new CalendarInfo();
	    id += 1;
	    calendar.id = String(id);
	    calendar.name = 'Offer';
	    calendar.color = '#578E1C';
	    calendar.bgColor = '#EEF8F0';
	    calendar.dragBgColor = '#EEF8F0';
	    calendar.borderColor = '#EEF8F0';
	    addCalendar(calendar);
	})();



	(function(window, Calendar) {

	    var cal, resizeThrottled;
	    var useCreationPopup = true;
	    var useDetailPopup = true;
	    var datePicker, selectedCalendar;

	    cal = new Calendar('#calendar', {
	        defaultView: 'month',
	        useCreationPopup: useCreationPopup,
	        useDetailPopup: useDetailPopup,
	        calendars: CalendarList,
	        template: {
	            milestone: function(model) {
	                return '<span class="calendar-font-icon ic-milestone-b"></span> <span style="background-color: ' + model.bgColor + '">' + model.title + '</span>';
	            },
	            allday: function(schedule) {
	                return getTimeTemplate(schedule, true);
	            },
	            time: function(schedule) {
	                return getTimeTemplate(schedule, false);
	            }
	        },
			month: {
				daynames: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
				startDayOfWeek: 0,
			},
			week: {
				daynames: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
			}
	    });

	    // event handlers
	    cal.on({
	        'clickMore': function(e) {
	            console.log('clickMore', e);
	        },
	        'clickSchedule': function(e) {
	            // var topValue;
	            // var leftValue;
	            // topValue = (e.event.clientY/2)+45;
	            // leftValue = e.event.clientX;
	            // if ( e.schedule.calendarId === '1' ) {
	            //     console.log('clickSchedule', e.schedule.calendarId);
	            // 				$("#post").fadeIn();
	            // $("#offer").fadeOut();
	            // $("#event").fadeOut();
	            // $("#create").fadeOut();
	            //     $(".promo_card").css({
	            //         top: topValue,
	            //         left: leftValue
	            //     })
	            //     return;
	            // }
	            // if ( e.schedule.calendarId === '2' ) {
	            //     console.log('clickSchedule', e.schedule.calendarId);
	            // 				$("#event").fadeIn();
	            // $("#post").fadeOut();
	            // $("#offer").fadeOut();
	            // $("#create").fadeOut();
	            //     $(".promo_card").css({
	            //         top: topValue,
	            //         left: leftValue
	            //     })
	            //     return;
	            // }
	            // if ( e.schedule.calendarId === '3' ) {
	            //     console.log('clickSchedule', e.schedule.calendarId);
	            // 				$("#offer").fadeIn();
	            // $("#post").fadeOut();
	            // $("#event").fadeOut();
	            // $("#create").fadeOut();
	            //     $(".promo_card").css({
	            //         top: topValue,
	            //         left: leftValue
	            //     })
	            //     return;
	            // }
	            // console.log('ada ', e.event.clientX)
	            // if( e.event.clientX > (window.windth - 200) ) {
	            // }
	            // console.log('clickSchedule', e);
	        },
	        'clickDayname': function(date) {
	            console.log('clickDayname', date);
	        },
	        'beforeCreateSchedule': function(e) {

	            // $("#create").fadeIn();
										
	            saveNewSchedule(e);
	        },
	        'beforeUpdateSchedule': function(e) {
	            var schedule = e.schedule;
	            var changes = e.changes;
				var data_changes = {
					data_start: new Date(e.start).toLocaleString().replace(',',''),
					data_end: new Date(e.end).toLocaleString().replace(',','')
				}

	            console.log('beforeUpdateSchedule', e);

	            cal.updateSchedule(schedule.id, schedule.calendarId, changes);

	            $.ajax({
	            	url: 'requisicoes/edita-agendamento.php',
	            	data: {
	            		id: schedule.id,
	            		agenda: schedule.calendarId,
	            		edicao: changes,
						Data: data_changes
	            	},
	            	cache: false,
	            	success: function(data){
	            		if (data == 1){
	            			swal("Sucesso!", "O agendamento foi atualizado com sucesso!", "success");
	            		}
	            	},
	            	error: function(){
	            		swal("Erro!", "Houve um erro ao atualizar o agendamento. Tente novamente mais tarde.", "error");
	            	}
	            })

	            refreshScheduleVisibility();
	        },
	        'beforeDeleteSchedule': function(e) {
	            console.log('beforeDeleteSchedule', e);
	            cal.deleteSchedule(e.schedule.id, e.schedule.calendarId);

	            $.ajax({
	            	url: 'requisicoes/deleta-agendamento.php',
	            	data: {
	            		id: e.schedule.id,
	            		agenda: e.schedule.calendarId
	            	},
	            	cache: false,
	            	success: function(data){
	            		if(data == 1){
	            			swal("Sucesso!", "O agendamento foi deletado!", "success");
	            		}
	            	},
	            	error: function(){
	            		swal("Erro!", "Houve um problema ao deletar o agendamento. Tente novamente mais tarde!", "error");
	            	}
	            })
	        },
	        'afterRenderSchedule': function(e) {
	            var schedule = e.schedule;
	            // var element = cal.getElement(schedule.id, schedule.calendarId);
	            // console.log('afterRenderSchedule', element);
	        },
	        'clickTimezonesCollapseBtn': function(timezonesCollapsed) {
	            console.log('timezonesCollapsed', timezonesCollapsed);

	            if (timezonesCollapsed) {
	                cal.setTheme({
	                    'week.daygridLeft.width': '77px',
	                    'week.timegridLeft.width': '77px'
	                });
	            } else {
	                cal.setTheme({
	                    'week.daygridLeft.width': '60px',
	                    'week.timegridLeft.width': '60px'
	                });
	            }

	            return true;
	        }
	    });

	    function getTimeTemplate(schedule, isAllDay) {
	        var html = [];
	        var start = moment(schedule.start.toUTCString());
	        if (!isAllDay) {
	            html.push('<strong>' + start.format('HH:mm') + '</strong> ');
	        }
	        if (schedule.isPrivate) {
	            html.push('<span class="calendar-font-icon ic-lock-b"></span>');
	            html.push(' Private');
	        } else {
	            if (schedule.isReadOnly) {
	                html.push('<span class="calendar-font-icon ic-readonly-b"></span>');
	            } else if (schedule.recurrenceRule) {
	                html.push('<span class="calendar-font-icon ic-repeat-b"></span>');
	            } else if (schedule.attendees.length) {
	                html.push('<span class="calendar-font-icon ic-user-b"></span>');
	            } else if (schedule.location) {
	                html.push('<span class="calendar-font-icon ic-location-b"></span>');
	            }
	            html.push(' ' + schedule.title);
	        }

	        return html.join('');
	    }

	    function onClickMenu(e) {
        var target = $(e.target).closest('a[role="menuitem"]')[0];
        var action = getDataAction(target);
        var options = cal.getOptions();
        var viewName = '';

        console.log(target);
        console.log(action);
        switch (action) {
          case 'toggle-daily':
            viewName = 'day';
            break;
          case 'toggle-weekly':
            viewName = 'week';
            break;
          case 'toggle-monthly':
            options.month.visibleWeeksCount = 0;
            viewName = 'month';
            break;
          case 'toggle-narrow-weekend':
            options.month.narrowWeekend = !options.month.narrowWeekend;
            options.week.narrowWeekend = !options.week.narrowWeekend;
            viewName = cal.getViewName();

            target.querySelector('input').checked = options.month.narrowWeekend;
            break;
          case 'toggle-start-day-1':
            options.month.startDayOfWeek = options.month.startDayOfWeek ? 0 : 1;
            options.week.startDayOfWeek = options.week.startDayOfWeek ? 0 : 1;
            viewName = cal.getViewName();

            target.querySelector('input').checked = options.month.startDayOfWeek;
            break;
          case 'toggle-workweek':
            options.month.workweek = !options.month.workweek;
            options.week.workweek = !options.week.workweek;
            viewName = cal.getViewName();

            target.querySelector('input').checked = !options.month.workweek;
            break;
          default:
            break;
        }

        cal.setOptions(options, true);
        cal.changeView(viewName, true);

        setDropdownCalendarType();
        setRenderRangeText();
        setSchedules();
	    }

	    function onClickNavi(e) {
	        var action = getDataAction(e.target);

	        switch (action) {
	            case 'move-prev':
	                cal.prev();
	                break;
	            case 'move-next':
	                cal.next();
	                break;
	            case 'move-today':
	                cal.today();
	                break;
	            default:
	                return;
	        }

	        setRenderRangeText();
	        setSchedules();
	    }

	    function setDropdownCalendarType() {
        var calendarTypeName = document.getElementById('calendarTypeName');
        var calendarTypeIcon = document.getElementById('calendarTypeIcon');
        var options = cal.getOptions();
        var type = cal.getViewName();
        var iconClassName;

        if (type === 'day') {
            type = 'Diário';
            iconClassName = 'calendar-icon ic_view_day';
        } else if (type === 'week') {
            type = 'Semanal';
            iconClassName = 'calendar-icon ic_view_week';
        } else if (options.month.visibleWeeksCount === 2) {
            type = '2 weeks';
            iconClassName = 'calendar-icon ic_view_week';
        } else if (options.month.visibleWeeksCount === 3) {
            type = '3 weeks';
            iconClassName = 'calendar-icon ic_view_week';
        } else {
            type = 'Mensal';
            iconClassName = 'calendar-icon ic_view_month';
        }

        calendarTypeName.innerHTML = type;
        calendarTypeIcon.className = iconClassName;
	    }

	    function onNewSchedule() {
	        var title = $('#new-schedule-title').val();
	        var location = $('#new-schedule-location').val();
	        var isAllDay = document.getElementById('new-schedule-allday').checked;
	        var start = datePicker.getStartDate();
	        var end = datePicker.getEndDate();
	        var calendar = selectedCalendar ? selectedCalendar : CalendarList[0];

	        if (!title) {
	            return;
	        }

	        console.log('calendar.id ', calendar.id)
	        cal.createSchedules([{
	            id: '1',
	            calendarId: calendar.id,
	            title: title,
	            isAllDay: isAllDay,
	            start: start,
	            end: end,
	            category: isAllDay ? 'allday' : 'time',
	            dueDateClass: '',
	            color: calendar.color,
	            bgColor: calendar.bgColor,
	            dragBgColor: calendar.bgColor,
	            borderColor: calendar.borderColor,
	            raw: {
	                location: location
	            },
	            state: 'Busy'
	        }]);

	        $('#modal-new-schedule').modal('hide');
	    }

	    function onChangeNewScheduleCalendar(e) {
	        var target = $(e.target).closest('a[role="menuitem"]')[0];
	        var calendarId = getDataAction(target);
	        changeNewScheduleCalendar(calendarId);
	    }

	    function changeNewScheduleCalendar(calendarId) {
	        var calendarNameElement = document.getElementById('calendarName');
	        var calendar = findCalendar(calendarId);
	        var html = [];

	        html.push('<span class="calendar-bar" style="background-color: ' + calendar.bgColor + '; border-color:' + calendar.borderColor + ';"></span>');
	        html.push('<span class="calendar-name">' + calendar.name + '</span>');

	        calendarNameElement.innerHTML = html.join('');

	        selectedCalendar = calendar;
	    }

	    function createNewSchedule(event) {
	        var start = event.start ? new Date(event.start.getTime()) : new Date();
	        var end = event.end ? new Date(event.end.getTime()) : moment().add(1, 'hours').toDate();

	        if (useCreationPopup) {
	            cal.openCreationPopup({
	                start: start,
	                end: end
	            });
	        }
	    }
	    function saveNewSchedule(scheduleData) {
	        console.log('scheduleData ', scheduleData)
	        var calendar = scheduleData.calendar || findCalendar(scheduleData.calendarId);
	        var schedule = {
	            id: '1',
	            title: scheduleData.title,
	            // isAllDay: scheduleData.isAllDay,
	            start: scheduleData.start,
	            end: scheduleData.end,
	            category: 'allday',
	            // category: scheduleData.isAllDay ? 'allday' : 'time',
	            // dueDateClass: '',
	            color: calendar.color,
	            bgColor: calendar.bgColor,
	            dragBgColor: calendar.bgColor,
	            borderColor: calendar.borderColor,
	            location: scheduleData.location,
	            // raw: {
	            //     class: scheduleData.raw['class']
	            // },
	            // state: scheduleData.state
	        };
	        if (calendar) {
	            schedule.calendarId = calendar.id;
	            schedule.color = calendar.color;
	            schedule.bgColor = calendar.bgColor;
	            schedule.borderColor = calendar.borderColor;
	        }

	        cal.createSchedules([schedule]);

	        refreshScheduleVisibility();
	    }


	    function refreshScheduleVisibility() {
	        var calendarElements = Array.prototype.slice.call(document.querySelectorAll('#calendarList input'));

	        CalendarList.forEach(function(calendar) {
	            cal.toggleSchedules(calendar.id, !calendar.checked, false);
	        });

	        cal.render(true);

	        calendarElements.forEach(function(input) {
	            var span = input.nextElementSibling;
	            span.style.backgroundColor = input.checked ? span.style.borderColor : 'transparent';
	        });
	    }


	    function setRenderRangeText() {
	        var renderRange = document.getElementById('renderRange');
	        var options = cal.getOptions();
	        var viewName = cal.getViewName();
	        var html = [];
	        if (viewName === 'day') {
	            html.push(moment(cal.getDate().getTime()).format('MMM YYYY DD'));
	        } else if (viewName === 'month' &&
	            (!options.month.visibleWeeksCount || options.month.visibleWeeksCount > 4)) {
	            html.push(moment(cal.getDate().getTime()).format('MMM YYYY'));
	        } else {
	            html.push(moment(cal.getDateRangeStart().getTime()).format('MMM YYYY DD'));
	            html.push(' ~ ');
	            html.push(moment(cal.getDateRangeEnd().getTime()).format(' MMM DD'));
	        }
	        renderRange.innerHTML = html.join('');
	    }
 
	    function setSchedules() {
	        cal.clear();
	        var schedules = [
	        <?php     
	        		$q = Query('SELECT * FROM servico_prestado WHERE  Parceiro = '.$_SESSION['Parceiro'].' ORDER BY Servico_prestado DESC',0);

	if(mysqli_num_rows($q) > 0){
		while($r = mysqli_fetch_assoc($q)){ 

			$data_inicio = $r['Data_abertura'];
			$data_fim = $r['Data_abertura'];

			if((isset($r['Data_agendamento']) && $r['Data_agendamento']!='0000-00-00')){
				$data_inicio = $r['Data_agendamento'];
				//$data_inicio = $r['Data_agendamento'];
				$data_fim = $data_inicio;
			}

 
   
			
			if(isset($r['Data_agendamento_fim']) && $r['Data_agendamento_fim']!='0000-00-00 00:00:00'){
				$data_fim = $r['Data_agendamento_fim'];
			}
         

	 ?>
	            {id: <?php  echo $r['Servico_prestado'];   ?>, title: '<?php  echo get('servico',$r['Servico']);   ?> - <?php  echo get('cliente',$r['Cliente']);   ?> - <?php  echo $r['Nome_responsavel'];   ?> - <?php  echo $r['Telefone_responsavel'];   ?> - R$ <?php  echo $r['Valor'];   ?>', isAllDay: false, start: '<?php  echo $data_inicio;   ?>', end: '<?php  echo $data_fim;   ?>', goingDuration: 30, comingDuration: 30, color: '#ffffff', isVisible: true, bgColor: '#69BB2D', dragBgColor: '#69BB2D', borderColor: '#69BB2D', calendarId: '1', category: 'allday', dueDateClass: '', customStyle: 'cursor: default;', isPending: false, isFocused: false, isReadOnly: false, isPrivate: false, location: '', attendees: '', recurrenceRule: '', state: ''},
	        <?php  }  }   ?>
	        ];
	        // generateSchedule(cal.getViewName(), cal.getDateRangeStart(), cal.getDateRangeEnd());
	        cal.createSchedules(schedules);
	        // cal.createSchedules(schedules);
	        refreshScheduleVisibility();
	    }

	    function setEventListener() {
	        $('#menu-navi').on('click', onClickNavi);
	        $('.dropdown-menu a[role="menuitem"]').on('click', onClickMenu);
	        // $('#lnb-calendars').on('change', onChangeCalendars);

	        $('#btn-save-schedule').on('click', onNewSchedule);
	        $('#btn-new-schedule').on('click', createNewSchedule);

	        $('#dropdownMenu-calendars-list').on('click', onChangeNewScheduleCalendar);

	        window.addEventListener('resize', resizeThrottled);
	    }

	    function getDataAction(target) {
	        return target.dataset ? target.dataset.action : target.getAttribute('data-action');
	    }

	    resizeThrottled = tui.util.throttle(function() {
	        cal.render();
	    }, 50);

	    window.cal = cal;

	    setDropdownCalendarType();
	    setRenderRangeText();
	    setSchedules();
	    setEventListener();
	})(window, tui.Calendar);

	// set calendars
	(function() {
	    // var calendarList = document.getElementById('calendarList');
	    // var html = [];
	    // CalendarList.forEach(function(calendar) {
	    //     html.push('<div class="lnb-calendars-item"><label>' +
	    //         '<input type="checkbox" class="tui-full-calendar-checkbox-round" value="' + calendar.id + '" checked>' +
	    //         '<span style="border-color: ' + calendar.borderColor + '; background-color: ' + calendar.borderColor + ';"></span>' +
	    //         '<span>' + calendar.name + '</span>' +
	    //         '</label></div>'
	    //     );
	    // });
	    // calendarList.innerHTML = html.join('\n');
	})();

	})
</script>
</body>
</html>