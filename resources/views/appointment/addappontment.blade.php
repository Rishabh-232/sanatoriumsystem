@extends('layouts.app')

@section('content')
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">
	<!-- <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome-font-awesome.min.css" rel="stylesheet"> -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/air-datepicker/2.2.3/css/datepicker.css" rel="stylesheet">
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.14/css/bootstrap-select.min.css" />
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/css/pages/choices.css') }}">
	<style type="text/css">
		
		/*!
		 * FullCalendar v3.9.0
		 * Docs & License: https://fullcalendar.io/
		 * (c) 2018 Adam Shaw
		 */
		.fc {
		  direction: ltr;
		  text-align: left; }

		.fc-rtl {
		  text-align: right; }

		body .fc {
		  /* extra precedence to overcome jqui */
		  font-size: 1em; }

		/* Colors
		--------------------------------------------------------------------------------------------------*/
		.fc-highlight {
		  /* when user is selecting cells */
		  background: #bce8f1;
		  opacity: .3; }

		.fc-bgevent {
		  /* default look for background events */
		  background: #8fdf82;
		  opacity: .3; }

		.fc-nonbusiness {
		  /* default look for non-business-hours areas */
		  /* will inherit .fc-bgevent's styles */
		  background: rgba(52,40,104,.05); }

		/* Buttons (styled <button> tags, normalized to work cross-browser)
		--------------------------------------------------------------------------------------------------*/
		.fc button {
		  /* force height to include the border and padding */
		  -moz-box-sizing: border-box;
		  -webkit-box-sizing: border-box;
		  box-sizing: border-box;
		  /* dimensions */
		  margin: 0;
		  height: auto;
		  padding: 0 .6em;
		  /* text & cursor */
		  font-size: 1em;
		  /* normalize */
		  white-space: nowrap;
		  cursor: pointer; }

		/* Firefox has an annoying inner border */
		.fc button::-moz-focus-inner {
		  margin: 0;
		  padding: 0; }

		.fc-state-default {
		  /* non-theme */
		  border: 1px solid; }

		.fc-state-default.fc-corner-left {
		  /* non-theme */
		  border-top-left-radius: 4px;
		  border-bottom-left-radius: 4px; }

		.fc-state-default.fc-corner-right {
		  /* non-theme */
		  border-top-right-radius: 4px;
		  border-bottom-right-radius: 4px; }

		/* icons in buttons */
		.fc button .fc-icon {
		  /* non-theme */
		  position: relative;
		  top: -0.05em;
		  /* seems to be a good adjustment across browsers */
		  margin: 0 .2em;
		  vertical-align: middle; }

		/*
		  button states
		  borrowed from twitter bootstrap (http://twitter.github.com/bootstrap/)
		*/
		.fc-state-default {
		  background-color: #f5f5f5;
		  background-image: -moz-linear-gradient(top, #ffffff, #e6e6e6);
		  background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#ffffff), to(#e6e6e6));
		  background-image: -webkit-linear-gradient(top, #ffffff, #e6e6e6);
		  background-image: -o-linear-gradient(top, #ffffff, #e6e6e6);
		  background-image: linear-gradient(to bottom, #ffffff, #e6e6e6);
		  background-repeat: repeat-x;
		  border-color: #e6e6e6 #e6e6e6 #bfbfbf;
		  border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
		  color: #333;
		  text-shadow: 0 1px 1px rgba(255, 255, 255, 0.75);
		  box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05); }

		.fc-state-hover,
		.fc-state-down,
		.fc-state-active,
		.fc-state-disabled {
		  color: #333333;
		  background-color: #e6e6e6; }

		.fc-state-hover {
		  color: #333333;
		  text-decoration: none;
		  background-position: 0 -15px;
		  -webkit-transition: background-position 0.1s linear;
		  -moz-transition: background-position 0.1s linear;
		  -o-transition: background-position 0.1s linear;
		  transition: background-position 0.1s linear; }

		.fc-state-down,
		.fc-state-active {
		  background-color: #cccccc;
		  background-image: none;
		  box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.15), 0 1px 2px rgba(0, 0, 0, 0.05); }

		.fc-state-disabled {
		  cursor: default;
		  background-image: none;
		  opacity: 0.65;
		  box-shadow: none; }

		/* Buttons Groups
		--------------------------------------------------------------------------------------------------*/
		.fc-button-group {
		  display: inline-block; }

		/*
		every button that is not first in a button group should scootch over one pixel and cover the
		previous button's border...
		*/
		.fc .fc-button-group > * {
		  /* extra precedence b/c buttons have margin set to zero */
		  float: left;
		  margin: 0 0 0 -1px; }

		.fc .fc-button-group > :first-child {
		  /* same */
		  margin-left: 0; }

		/* Popover
		--------------------------------------------------------------------------------------------------*/
		.fc-popover {
		  position: absolute;
		  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15); }

		.fc-popover .fc-header {
		  /* TODO: be more consistent with fc-head/fc-body */
		  padding: 2px 4px; }

		.fc-popover .fc-header .fc-title {
		  margin: 0 2px; }

		.fc-popover .fc-header .fc-close {
		  cursor: pointer; }

		.fc-ltr .fc-popover .fc-header .fc-title,
		.fc-rtl .fc-popover .fc-header .fc-close {
		  float: left; }

		.fc-rtl .fc-popover .fc-header .fc-title,
		.fc-ltr .fc-popover .fc-header .fc-close {
		  float: right; }

		/* Misc Reusable Components
		--------------------------------------------------------------------------------------------------*/
		.fc-divider {
		  border-style: solid;
		  border-width: 1px; }

		hr.fc-divider {
		  height: 0;
		  margin: 0;
		  padding: 0 0 2px;
		  /* height is unreliable across browsers, so use padding */
		  border-width: 1px 0; }

		.fc-clear {
		  clear: both; }

		.fc-bg,
		.fc-bgevent-skeleton,
		.fc-highlight-skeleton,
		.fc-helper-skeleton {
		  /* these element should always cling to top-left/right corners */
		  position: absolute;
		  top: 0;
		  left: 0;
		  right: 0; }

		.fc-bg {
		  bottom: 0;
		  /* strech bg to bottom edge */ }

		.fc-bg table {
		  height: 100%;
		  /* strech bg to bottom edge */ }

		/* Tables
		--------------------------------------------------------------------------------------------------*/
		.fc table {
		  width: 100%;
		  box-sizing: border-box;
		  /* fix scrollbar issue in firefox */
		  table-layout: fixed;
		  border-collapse: collapse;
		  border-spacing: 0;
		  font-size: 1em;
		  /* normalize cross-browser */ }

		.fc th {
		  text-align: center; }

		.fc th,
		.fc td {
		  border-style: solid;
		  border-width: 1px 1px 0 1px !important;
		  padding: 0;
		  border-color: #eee;
		  vertical-align: top;
		}

		.fc td.fc-today {
		  border-style: double;
		  /* overcome neighboring borders */ }

		/* Internal Nav Links
		--------------------------------------------------------------------------------------------------*/
		a[data-goto] {
		  cursor: pointer; }

		a[data-goto]:hover {
		  text-decoration: underline; }

		/* Fake Table Rows
		--------------------------------------------------------------------------------------------------*/
		.fc .fc-row {
		  /* extra precedence to overcome themes w/ .ui-widget-content forcing a 1px border */
		  /* no visible border by default. but make available if need be (scrollbar width compensation) */
		  border-style: solid;
		  border-width: 0; }

		.fc-row table {
		  /* don't put left/right border on anything within a fake row.
		     the outer tbody will worry about this */
		  border-left: 0 hidden transparent;
		  border-right: 0 hidden transparent;
		  /* no bottom borders on rows */
		  border-bottom: 0 hidden transparent; }

		.fc-row:first-child table {
		  border-top: 0 hidden transparent;
		  /* no top border on first row */ }

		/* Day Row (used within the header and the DayGrid)
		--------------------------------------------------------------------------------------------------*/
		.fc-row {
		  position: relative;
		  background: #ffffff;
		}

		.fc-row .fc-bg {
		  z-index: 1; }

		/* highlighting cells & background event skeleton */
		.fc-row .fc-bgevent-skeleton,
		.fc-row .fc-highlight-skeleton {
		  bottom: 0;
		  /* stretch skeleton to bottom of row */ }

		.fc-row .fc-bgevent-skeleton table,
		.fc-row .fc-highlight-skeleton table {
		  height: 100%;
		  /* stretch skeleton to bottom of row */ }

		.fc-row .fc-highlight-skeleton td,
		.fc-row .fc-bgevent-skeleton td {
		  border-color: transparent; }

		.fc-row .fc-bgevent-skeleton {
		  z-index: 2; }

		.fc-row .fc-highlight-skeleton {
		  z-index: 3; }

		/*
		row content (which contains day/week numbers and events) as well as "helper" (which contains
		temporary rendered events).
		*/
		.fc-row .fc-content-skeleton {
		  position: relative;
		  z-index: 4;
		  padding-bottom: 2px;
		  /* matches the space above the events */ }

		.fc-row .fc-helper-skeleton {
		  z-index: 5; }

		.fc .fc-row .fc-content-skeleton table,
		.fc .fc-row .fc-content-skeleton td,
		.fc .fc-row .fc-helper-skeleton td {
		  /* see-through to the background below */
		  /* extra precedence to prevent theme-provided backgrounds */
		  background: none;
		  /* in case <td>s are globally styled */
		  border-color: transparent;
		  padding: .5rem .5rem;
		}

		.fc-row .fc-content-skeleton td,
		.fc-row .fc-helper-skeleton td {
		  /* don't put a border between events and/or the day number */
		  border-bottom: 0; }

		.fc-row .fc-content-skeleton tbody td,
		.fc-row .fc-helper-skeleton tbody td {
		  /* don't put a border between event cells */
		  border-top: 0; }

		/* Scrolling Container
		--------------------------------------------------------------------------------------------------*/
		.fc-scroller {
		  -webkit-overflow-scrolling: touch; }

		/* TODO: move to agenda/basic */
		.fc-scroller > .fc-day-grid,
		.fc-scroller > .fc-time-grid {
		  position: relative;
		  /* re-scope all positions */
		  width: 100%;
		  /* hack to force re-sizing this inner element when scrollbars appear/disappear */ }

		/* Global Event Styles
		--------------------------------------------------------------------------------------------------*/
		.fc-event {
		  position: relative;
		  /* for resize handle and other inner positioning */
		  display: block;
		  /* make the <a> tag block */
		  font-size: 12px;
		  line-height: 1.3;
		  letter-spacing: 0.02em;
		  border-radius: 3px;
		  font-weight: 500;
		  border: 1px solid #ddd;
		  -webkit-box-shadow: 0px 1px 15px rgba(0, 0, 0, 0.05);
		  -moz-box-shadow: 0px 1px 15px rgba(0, 0, 0, 0.05);
		  box-shadow: 0px 1px 15px rgba(0, 0, 0, 0.05);
		  /* default BORDER color */ }

		.fc-event,
		.fc-event-dot {
		  background-color: #ffffff;
		  color: #5d5386;
		  position: relative;
		  /* default BACKGROUND color */ }
		.fc-event:before,
		.fc-event-dot:before{
		    content: "";
		    position: absolute;
		    left: 0;
		    bottom: -2px;
		    width: 50px;
		    height: 100%;
		    border-left: 3px solid #5d5386;
		    border-bottom: 3px solid #5d5386;
		    -webkit-border-radius: 3px 0px 0px 3px;
		    -moz-border-radius: 3px 0px 0px 3px;
		    border-radius: 3px 0px 0px 3px;
		}
		.fc-event .fc-title {
		    font-weight: 500;
		}
		.fc-event i{
		    font-size: 26px;
		    margin-right: 8px;
		    vertical-align: middle;
		}
		.fc-event,
		.fc-event:hover {
		  color: #fff;
		  /* default TEXT color */
		  text-decoration: none;
		  /* if <a> has an href */ }

		.fc-event[href],
		.fc-event.fc-draggable {
		  cursor: pointer;
		  /* give events with links and draggable events a hand mouse pointer */ }

		.fc-not-allowed,
		.fc-not-allowed .fc-event {
		  /* to override an event's custom cursor */
		  cursor: not-allowed; }

		.fc-event .fc-bg {
		  /* the generic .fc-bg already does position */
		  z-index: 1;
		  background: #fff;
		  opacity: .25; }

		.fc-event .fc-content {
		    color: #2c304d;
		    position: relative;
		    z-index: 2;
		    padding: 8px;
		}

		/* resizer (cursor AND touch devices) */
		.fc-event .fc-resizer {
		  position: absolute;
		  z-index: 4; }

		/* resizer (touch devices) */
		.fc-event .fc-resizer {
		  display: none; }

		.fc-event.fc-allow-mouse-resize .fc-resizer,
		.fc-event.fc-selected .fc-resizer {
		  /* only show when hovering or selected (with touch) */
		  display: block; }

		/* hit area */
		.fc-event.fc-selected .fc-resizer:before {
		  /* 40x40 touch area */
		  content: "";
		  position: absolute;
		  z-index: 9999;
		  /* user of this util can scope within a lower z-index */
		  top: 50%;
		  left: 50%;
		  width: 40px;
		  height: 40px;
		  margin-left: -20px;
		  margin-top: -20px; }

		/* Event Selection (only for touch devices)
		--------------------------------------------------------------------------------------------------*/
		.fc-event.fc-selected {
		  z-index: 9999 !important;
		  /* overcomes inline z-index */
		  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2); }

		.fc-event.fc-selected.fc-dragging {
		  box-shadow: 0 2px 7px rgba(0, 0, 0, 0.3); }

		/* Horizontal Events
		--------------------------------------------------------------------------------------------------*/
		/* bigger touch area when selected */
		.fc-h-event.fc-selected:before {
		  content: "";
		  position: absolute;
		  z-index: 3;
		  /* below resizers */
		  top: -10px;
		  bottom: -10px;
		  left: 0;
		  right: 0; }

		/* events that are continuing to/from another week. kill rounded corners and butt up against edge */
		.fc-ltr .fc-h-event.fc-not-start,
		.fc-rtl .fc-h-event.fc-not-end {
		  margin-left: 0;
		  border-left-width: 0;
		  padding-left: 1px;
		  /* replace the border with padding */
		  border-top-left-radius: 0;
		  border-bottom-left-radius: 0; }

		.fc-ltr .fc-h-event.fc-not-end,
		.fc-rtl .fc-h-event.fc-not-start {
		  margin-right: 0;
		  border-right-width: 0;
		  padding-right: 1px;
		  /* replace the border with padding */
		  border-top-right-radius: 0;
		  border-bottom-right-radius: 0; }

		/* resizer (cursor AND touch devices) */
		/* left resizer  */
		.fc-ltr .fc-h-event .fc-start-resizer,
		.fc-rtl .fc-h-event .fc-end-resizer {
		  cursor: w-resize;
		  left: -1px;
		  /* overcome border */ }

		/* right resizer */
		.fc-ltr .fc-h-event .fc-end-resizer,
		.fc-rtl .fc-h-event .fc-start-resizer {
		  cursor: e-resize;
		  right: -1px;
		  /* overcome border */ }

		/* resizer (mouse devices) */
		.fc-h-event.fc-allow-mouse-resize .fc-resizer {
		  width: 7px;
		  top: -1px;
		  /* overcome top border */
		  bottom: -1px;
		  /* overcome bottom border */ }

		/* resizer (touch devices) */
		.fc-h-event.fc-selected .fc-resizer {
		  /* 8x8 little dot */
		  border-radius: 4px;
		  border-width: 1px;
		  width: 6px;
		  height: 6px;
		  border-style: solid;
		  border-color: inherit;
		  background: #fff;
		  /* vertically center */
		  top: 50%;
		  margin-top: -4px; }

		/* left resizer  */
		.fc-ltr .fc-h-event.fc-selected .fc-start-resizer,
		.fc-rtl .fc-h-event.fc-selected .fc-end-resizer {
		  margin-left: -4px;
		  /* centers the 8x8 dot on the left edge */ }

		/* right resizer */
		.fc-ltr .fc-h-event.fc-selected .fc-end-resizer,
		.fc-rtl .fc-h-event.fc-selected .fc-start-resizer {
		  margin-right: -4px;
		  /* centers the 8x8 dot on the right edge */ }

		/* DayGrid events
		----------------------------------------------------------------------------------------------------
		We use the full "fc-day-grid-event" class instead of using descendants because the event won't
		be a descendant of the grid when it is being dragged.
		*/
		.fc-day-grid-event {
		  margin: 1px 2px 0;
		  /* spacing between events and edges */
		  padding: 0; }

		tr:first-child > td > .fc-day-grid-event {
		  margin-top: 2px;
		  /* a little bit more space before the first event */ }

		.fc-day-grid-event.fc-selected:after {
		  content: "";
		  position: absolute;
		  z-index: 1;
		  /* same z-index as fc-bg, behind text */
		  /* overcome the borders */
		  top: -1px;
		  right: -1px;
		  bottom: -1px;
		  left: -1px;
		  /* darkening effect */
		  background: #000;
		  opacity: .25; }

		.fc-day-grid-event .fc-content {
		  /* force events to be one-line tall */
		  white-space: nowrap;
		  overflow: hidden; }

		.fc-day-grid-event .fc-time {
		  font-weight: bold; }

		/* resizer (cursor devices) */
		/* left resizer  */
		.fc-ltr .fc-day-grid-event.fc-allow-mouse-resize .fc-start-resizer,
		.fc-rtl .fc-day-grid-event.fc-allow-mouse-resize .fc-end-resizer {
		  margin-left: -2px;
		  /* to the day cell's edge */ }

		/* right resizer */
		.fc-ltr .fc-day-grid-event.fc-allow-mouse-resize .fc-end-resizer,
		.fc-rtl .fc-day-grid-event.fc-allow-mouse-resize .fc-start-resizer {
		  margin-right: -2px;
		  /* to the day cell's edge */ }

		/* Event Limiting
		--------------------------------------------------------------------------------------------------*/
		/* "more" link that represents hidden events */
		a.fc-more {
		  margin: 1px 3px;
		  font-size: .85em;
		  cursor: pointer;
		  text-decoration: none; }

		a.fc-more:hover {
		  text-decoration: underline; }

		.fc-limited {
		  /* rows and cells that are hidden because of a "more" link */
		  display: none; }

		/* popover that appears when "more" link is clicked */
		.fc-day-grid .fc-row {
		  z-index: 1;
		  /* make the "more" popover one higher than this */ }

		.fc-more-popover {
		  z-index: 2;
		  width: 220px; }

		.fc-more-popover .fc-event-container {
		  padding: 10px; }

		/* Now Indicator
		--------------------------------------------------------------------------------------------------*/
		.fc-now-indicator {
		  position: absolute;
		  border: 0 solid red; }

		/* Utilities
		--------------------------------------------------------------------------------------------------*/
		.fc-unselectable {
		  -webkit-user-select: none;
		  -khtml-user-select: none;
		  -moz-user-select: none;
		  -ms-user-select: none;
		  user-select: none;
		  -webkit-touch-callout: none;
		  -webkit-tap-highlight-color: transparent; }

		/*
		TODO: more distinction between this file and common.css
		*/
		/* Colors
		--------------------------------------------------------------------------------------------------*/
		.fc-unthemed th,
		.fc-unthemed td,
		.fc-unthemed thead,
		.fc-unthemed tbody,
		.fc-unthemed .fc-divider,
		.fc-unthemed .fc-row,
		.fc-unthemed .fc-content,
		.fc-unthemed .fc-popover,
		.fc-unthemed .fc-list-view,
		.fc-unthemed .fc-list-heading td {
		  border-color: #ddd; }

		.fc-unthemed .fc-popover {
		  background-color: #fff; }

		.fc-unthemed .fc-divider,
		.fc-unthemed .fc-popover .fc-header,
		.fc-unthemed .fc-list-heading td {
		  background: #eee; }

		.fc-unthemed .fc-popover .fc-header .fc-close {
		  color: #666; }

		.fc-unthemed td.fc-today {
		  background: #fcf8e3; }

		.fc-unthemed .fc-disabled-day {
		  background: #d7d7d7;
		  opacity: .3; }

		/* Icons (inline elements with styled text that mock arrow icons)
		--------------------------------------------------------------------------------------------------*/
		.fc-icon {
		  display: inline-block;
		  height: 1em;
		  line-height: 1em;
		  font-size: 1em;
		  text-align: center;
		  overflow: hidden;
		  font-family: "Courier New", Courier, monospace;
		  /* don't allow browser text-selection */
		  -webkit-touch-callout: none;
		  -webkit-user-select: none;
		  -khtml-user-select: none;
		  -moz-user-select: none;
		  -ms-user-select: none;
		  user-select: none; }

		/*
		Acceptable font-family overrides for individual icons:
		  "Arial", sans-serif
		  "Times New Roman", serif

		NOTE: use percentage font sizes or else old IE chokes
		*/
		.fc-icon:after {
		  position: relative; }

		.fc-icon-left-single-arrow:after {
		  content: "\2039";
		  font-weight: bold;
		  font-size: 200%;
		  top: -7%; }

		.fc-icon-right-single-arrow:after {
		  content: "\203A";
		  font-weight: bold;
		  font-size: 200%;
		  top: -7%; }

		.fc-icon-left-double-arrow:after {
		  content: "\AB";
		  font-size: 160%;
		  top: -7%; }

		.fc-icon-right-double-arrow:after {
		  content: "\BB";
		  font-size: 160%;
		  top: -7%; }

		.fc-icon-left-triangle:after {
		  content: "\25C4";
		  font-size: 125%;
		  top: 3%; }

		.fc-icon-right-triangle:after {
		  content: "\25BA";
		  font-size: 125%;
		  top: 3%; }

		.fc-icon-down-triangle:after {
		  content: "\25BC";
		  font-size: 125%;
		  top: 2%; }

		.fc-icon-x:after {
		  content: "\D7";
		  font-size: 200%;
		  top: 6%; }

		/* Popover
		--------------------------------------------------------------------------------------------------*/
		.fc-unthemed .fc-popover {
		  border-width: 1px;
		  border-style: solid; }

		.fc-unthemed .fc-popover .fc-header .fc-close {
		  font-size: .9em;
		  margin-top: 2px; }

		/* List View
		--------------------------------------------------------------------------------------------------*/
		.fc-unthemed .fc-list-item:hover td {
		  background-color: #f5f5f5; }

		/* Colors
		--------------------------------------------------------------------------------------------------*/
		.ui-widget .fc-disabled-day {
		  background-image: none; }

		/* Popover
		--------------------------------------------------------------------------------------------------*/
		.fc-popover > .ui-widget-header + .ui-widget-content {
		  border-top: 0;
		  /* where they meet, let the header have the border */ }

		/* Global Event Styles
		--------------------------------------------------------------------------------------------------*/
		.ui-widget .fc-event {
		  /* overpower jqui's styles on <a> tags. TODO: more DRY */
		  color: #fff;
		  /* default TEXT color */
		  text-decoration: none;
		  /* if <a> has an href */
		  /* undo ui-widget-header bold */
		  font-weight: normal; }

		/* TimeGrid axis running down the side (for both the all-day area and the slot area)
		--------------------------------------------------------------------------------------------------*/
		.ui-widget td.fc-axis {
		  font-weight: normal;
		  /* overcome bold */ }

		/* TimeGrid Slats (lines that run horizontally)
		--------------------------------------------------------------------------------------------------*/
		.fc-time-grid .fc-slats .ui-widget-content {
		  background: none;
		  /* see through to fc-bg */ }

		.fc.fc-bootstrap3 a {
		  text-decoration: none; }

		.fc.fc-bootstrap3 a[data-goto]:hover {
		  text-decoration: underline; }

		.fc-bootstrap3 hr.fc-divider {
		  border-color: inherit; }

		.fc-bootstrap3 .fc-today.alert {
		  border-radius: 0; }

		/* Popover
		--------------------------------------------------------------------------------------------------*/
		.fc-bootstrap3 .fc-popover .panel-body {
		  padding: 0; }

		/* TimeGrid Slats (lines that run horizontally)
		--------------------------------------------------------------------------------------------------*/
		.fc-bootstrap3 .fc-time-grid .fc-slats table {
		  /* some themes have background color. see through to slats */
		  background: none; }

		.fc.fc-bootstrap4 a {
		  text-decoration: none; }

		.fc.fc-bootstrap4 a[data-goto]:hover {
		  text-decoration: underline; }

		.fc-bootstrap4 hr.fc-divider {
		  border-color: inherit; }

		.fc-bootstrap4 .fc-today.alert {
		  border-radius: 0; }

		.fc-bootstrap4 a.fc-event:not([href]):not([tabindex]) {
		  color: #5d5386; }

		.fc-bootstrap4 .fc-popover.card {
		  position: absolute; }

		/* Popover
		--------------------------------------------------------------------------------------------------*/
		.fc-bootstrap4 .fc-popover .card-body {
		  padding: 0; }

		/* TimeGrid Slats (lines that run horizontally)
		--------------------------------------------------------------------------------------------------*/
		.fc-bootstrap4 .fc-time-grid .fc-slats table {
		  /* some themes have background color. see through to slats */
		  background: none; }

		/* Toolbar
		--------------------------------------------------------------------------------------------------*/
		.fc-toolbar {
		  text-align: center; }

		.fc-toolbar.fc-header-toolbar {
		  margin-bottom: 1em; }

		.fc-toolbar.fc-footer-toolbar {
		  margin-top: 1em; }

		.fc-toolbar .fc-left {
		  float: left; }

		.fc-toolbar .fc-right {
		  float: right; }

		.fc-toolbar .fc-center {
		  display: inline-block; }

		.fc button {
		    -webkit-box-sizing: border-box;
		    -moz-box-sizing: border-box;
		    box-sizing: border-box;
		    margin: 0;
		    height: auto;
		    padding: 0 1rem;
		    font-size: 1rem;
		    white-space: nowrap;
		    cursor: pointer;
		}

		/* the things within each left/right/center section */
		.fc .fc-toolbar > * > * {
		  /* extra precedence to override button border margins */
		  float: left;
		  margin-left: .75em; }

		/* the first thing within each left/center/right section */
		.fc .fc-toolbar > * > :first-child {
		  /* extra precedence to override button border margins */
		  margin-left: 0; }

		/* title text */
		.fc-toolbar h2 {
		  margin: 0;
		  font-size: 15px;
		  font-weight: 700;
		}

		/* button layering (for border precedence) */
		.fc-toolbar button {
		  position: relative; }

		.fc-toolbar .fc-state-hover,
		.fc-toolbar .ui-state-hover {
		  z-index: 2; }

		.fc-toolbar .fc-state-down {
		  z-index: 3; }

		.fc-toolbar .fc-state-active,
		.fc-toolbar .ui-state-active {
		  z-index: 4; }

		.fc-toolbar button:focus {
		  z-index: 5; }

		/* View Structure
		--------------------------------------------------------------------------------------------------*/
		/* undo twitter bootstrap's box-sizing rules. normalizes positioning techniques */
		/* don't do this for the toolbar because we'll want bootstrap to style those buttons as some pt */
		.fc-view-container *,
		.fc-view-container *:before,
		.fc-view-container *:after {
		  -webkit-box-sizing: content-box;
		  -moz-box-sizing: content-box;
		  box-sizing: content-box; }

		.fc-view,
		.fc-view > table {
		  /* so dragged elements can be above the view's main element */
		  position: relative;
		  z-index: 1; }

		/* BasicView
		--------------------------------------------------------------------------------------------------*/
		/* day row structure */
		.fc-basicWeek-view .fc-content-skeleton,
		.fc-basicDay-view .fc-content-skeleton {
		  /* there may be week numbers in these views, so no padding-top */
		  padding-bottom: 1em;
		  /* ensure a space at bottom of cell for user selecting/clicking */ }

		.fc-basic-view .fc-body .fc-row {
		  min-height: 4em;
		  /* ensure that all rows are at least this tall */ }

		/* a "rigid" row will take up a constant amount of height because content-skeleton is absolute */
		.fc-row.fc-rigid {
		  overflow: hidden; }

		.fc-row.fc-rigid .fc-content-skeleton {
		  position: absolute;
		  top: 0;
		  left: 0;
		  right: 0; }

		/* week and day number styling */
		.fc-day-top.fc-other-month {
		  opacity: 0.3; }

		.fc-basic-view .fc-week-number,
		.fc-basic-view .fc-day-number {
		  padding: 2px;
		  color: rgba(52,40,104,.8);
		  font-size: 15px;
		  font-weight: 400;
		}

		.fc-basic-view th.fc-week-number,
		.fc-basic-view th.fc-day-number {
		  padding: 0 2px;
		  /* column headers can't have as much v space */ }

		.fc-ltr .fc-basic-view .fc-day-top .fc-day-number {
		  float: right; }

		.fc-rtl .fc-basic-view .fc-day-top .fc-day-number {
		  float: left; }

		.fc-ltr .fc-basic-view .fc-day-top .fc-week-number {
		  float: left;
		  border-radius: 0 0 3px 0; }

		.fc-rtl .fc-basic-view .fc-day-top .fc-week-number {
		  float: right;
		  border-radius: 0 0 0 3px; }

		.fc-basic-view .fc-day-top .fc-week-number {
		  min-width: 1.5em;
		  text-align: center;
		  background-color: #f2f2f2;
		  color: #808080; }

		/* when week/day number have own column */
		.fc-basic-view td.fc-week-number {
		  text-align: center; }

		.fc-basic-view td.fc-week-number > * {
		  /* work around the way we do column resizing and ensure a minimum width */
		  display: inline-block;
		  min-width: 1.25em; }

		/* AgendaView all-day area
		--------------------------------------------------------------------------------------------------*/
		.fc-agenda-view .fc-day-grid {
		  position: relative;
		  z-index: 2;
		  /* so the "more.." popover will be over the time grid */ }

		.fc-agenda-view .fc-day-grid .fc-row {
		  min-height: 3em;
		  /* all-day section will never get shorter than this */ }

		.fc-agenda-view .fc-day-grid .fc-row .fc-content-skeleton {
		  padding-bottom: 1em;
		  /* give space underneath events for clicking/selecting days */ }

		/* TimeGrid axis running down the side (for both the all-day area and the slot area)
		--------------------------------------------------------------------------------------------------*/
		.fc .fc-axis {
		  /* .fc to overcome default cell styles */
		  vertical-align: middle;
		  padding: 0 4px;
		  white-space: nowrap; }

		.fc-ltr .fc-axis {
		  text-align: right; }

		.fc-rtl .fc-axis {
		  text-align: left; }

		/* TimeGrid Structure
		--------------------------------------------------------------------------------------------------*/
		.fc-time-grid-container,
		.fc-time-grid {
		  /* so slats/bg/content/etc positions get scoped within here */
		  position: relative;
		  z-index: 1; }

		.fc-time-grid {
		  min-height: 100%;
		  /* so if height setting is 'auto', .fc-bg stretches to fill height */ }

		.fc-time-grid table {
		  /* don't put outer borders on slats/bg/content/etc */
		  border: 0 hidden transparent; }

		.fc-time-grid > .fc-bg {
		  z-index: 1;
		  background: #fff;
		}

		.fc-time-grid .fc-slats,
		.fc-time-grid > hr {
		  /* the <hr> AgendaView injects when grid is shorter than scroller */
		  position: relative;
		  z-index: 2; }

		.fc-time-grid .fc-content-col {
		  position: relative;
		  /* because now-indicator lives directly inside */ }

		.fc-time-grid .fc-content-skeleton {
		  position: absolute;
		  z-index: 3;
		  top: 0;
		  left: 0;
		  right: 0; }

		/* divs within a cell within the fc-content-skeleton */
		.fc-time-grid .fc-business-container {
		  position: relative;
		  z-index: 1; }

		.fc-time-grid .fc-bgevent-container {
		  position: relative;
		  z-index: 2; }

		.fc-time-grid .fc-highlight-container {
		  position: relative;
		  z-index: 3; }

		.fc-time-grid .fc-event-container {
		  position: relative;
		  z-index: 4; }

		.fc-time-grid .fc-now-indicator-line {
		  z-index: 5; }

		.fc-time-grid .fc-helper-container {
		  /* also is fc-event-container */
		  position: relative;
		  z-index: 6; }

		/* TimeGrid Slats (lines that run horizontally)
		--------------------------------------------------------------------------------------------------*/
		.fc-time-grid .fc-slats td {
		  height: 1.5em;
		  border-bottom: 0;
		  padding: 10px;
		  /* each cell is responsible for its top border */ }
		.fc-agendaDay-view .fc-time-grid .fc-slats td{
		  background: #ffffff;
		}
		.fc-time-grid .fc-slats .fc-minor td {
		  border-top-style: dotted; }

		/* TimeGrid Highlighting Slots
		--------------------------------------------------------------------------------------------------*/
		.fc-time-grid .fc-highlight-container {
		  /* a div within a cell within the fc-highlight-skeleton */
		  position: relative;
		  /* scopes the left/right of the fc-highlight to be in the column */ }

		.fc-time-grid .fc-highlight {
		  position: absolute;
		  left: 0;
		  right: 0;
		  /* top and bottom will be in by JS */ }

		/* TimeGrid Event Containment
		--------------------------------------------------------------------------------------------------*/
		.fc-ltr .fc-time-grid .fc-event-container {
		  /* space on the sides of events for LTR (default) */
		  margin: 0 2.5% 0 2px; }

		.fc-rtl .fc-time-grid .fc-event-container {
		  /* space on the sides of events for RTL */
		  margin: 0 2px 0 2.5%; }

		.fc-time-grid .fc-event,
		.fc-time-grid .fc-bgevent {
		  position: absolute;
		  z-index: 1;
		  /* scope inner z-index's */ }

		.fc-time-grid .fc-bgevent {
		  /* background events always span full width */
		  left: 0;
		  right: 0; }

		/* Generic Vertical Event
		--------------------------------------------------------------------------------------------------*/
		.fc-v-event.fc-not-start {
		  /* events that are continuing from another day */
		  /* replace space made by the top border with padding */
		  border-top-width: 0;
		  padding-top: 1px;
		  /* remove top rounded corners */
		  border-top-left-radius: 0;
		  border-top-right-radius: 0; }

		.fc-v-event.fc-not-end {
		  /* replace space made by the top border with padding */
		  border-bottom-width: 0;
		  padding-bottom: 1px;
		  /* remove bottom rounded corners */
		  border-bottom-left-radius: 0;
		  border-bottom-right-radius: 0; }

		/* TimeGrid Event Styling
		----------------------------------------------------------------------------------------------------
		We use the full "fc-time-grid-event" class instead of using descendants because the event won't
		be a descendant of the grid when it is being dragged.
		*/
		.fc-time-grid-event {
		  overflow: hidden;
		  /* don't let the bg flow over rounded corners */ }

		.fc-time-grid-event.fc-selected {
		  /* need to allow touch resizers to extend outside event's bounding box */
		  /* common fc-selected styles hide the fc-bg, so don't need this anyway */
		  overflow: visible; }

		.fc-time-grid-event.fc-selected .fc-bg {
		  display: none;
		  /* hide semi-white background, to appear darker */ }

		.fc-time-grid-event .fc-content {
		  overflow: hidden;
		  /* for when .fc-selected */ }

		.fc-time-grid-event .fc-time,
		.fc-time-grid-event .fc-title {
		  padding: 0 1px; }

		.fc-time-grid-event .fc-time {
		  font-size: .85em;
		  white-space: nowrap; }

		/* short mode, where time and title are on the same line */
		.fc-time-grid-event.fc-short .fc-content {
		  /* don't wrap to second line (now that contents will be inline) */
		  white-space: nowrap; }

		.fc-time-grid-event.fc-short .fc-time,
		.fc-time-grid-event.fc-short .fc-title {
		  /* put the time and title on the same line */
		  display: inline-block;
		  vertical-align: top; }

		.fc-time-grid-event.fc-short .fc-time span {
		  display: none;
		  /* don't display the full time text... */ }

		.fc-time-grid-event.fc-short .fc-time:before {
		  content: attr(data-start);
		  /* ...instead, display only the start time */ }

		.fc-time-grid-event.fc-short .fc-time:after {
		  content: "\A0-\A0";
		  /* seperate with a dash, wrapped in nbsp's */ }

		.fc-time-grid-event.fc-short .fc-title {
		  font-size: .85em;
		  /* make the title text the same size as the time */
		  padding: 0;
		  /* undo padding from above */ }

		/* resizer (cursor device) */
		.fc-time-grid-event.fc-allow-mouse-resize .fc-resizer {
		  left: 0;
		  right: 0;
		  bottom: 0;
		  height: 8px;
		  overflow: hidden;
		  line-height: 8px;
		  font-size: 11px;
		  font-family: monospace;
		  text-align: center;
		  cursor: s-resize; }

		.fc-time-grid-event.fc-allow-mouse-resize .fc-resizer:after {
		  content: "="; }

		/* resizer (touch device) */
		.fc-time-grid-event.fc-selected .fc-resizer {
		  /* 10x10 dot */
		  border-radius: 5px;
		  border-width: 1px;
		  width: 8px;
		  height: 8px;
		  border-style: solid;
		  border-color: inherit;
		  background: #fff;
		  /* horizontally center */
		  left: 50%;
		  margin-left: -5px;
		  /* center on the bottom edge */
		  bottom: -5px; }

		/* Now Indicator
		--------------------------------------------------------------------------------------------------*/
		.fc-time-grid .fc-now-indicator-line {
		  border-top-width: 1px;
		  left: 0;
		  right: 0; }

		/* arrow on axis */
		.fc-time-grid .fc-now-indicator-arrow {
		  margin-top: -5px;
		  /* vertically center on top coordinate */ }

		.fc-ltr .fc-time-grid .fc-now-indicator-arrow {
		  left: 0;
		  /* triangle pointing right... */
		  border-width: 5px 0 5px 6px;
		  border-top-color: transparent;
		  border-bottom-color: transparent; }

		.fc-rtl .fc-time-grid .fc-now-indicator-arrow {
		  right: 0;
		  /* triangle pointing left... */
		  border-width: 5px 6px 5px 0;
		  border-top-color: transparent;
		  border-bottom-color: transparent; }

		/* List View
		--------------------------------------------------------------------------------------------------*/
		/* possibly reusable */
		.fc-event-dot {
		  display: inline-block;
		  width: 10px;
		  height: 10px;
		  border-radius: 5px; }

		/* view wrapper */
		.fc-rtl .fc-list-view {
		  direction: rtl;
		  /* unlike core views, leverage browser RTL */ }

		.fc-list-view {
		  border-width: 1px;
		  border-style: solid; }

		/* table resets */
		.fc .fc-list-table {
		  table-layout: auto;
		  /* for shrinkwrapping cell content */ }

		.fc-list-table td {
		  border-width: 1px 0 0;
		  padding: 8px 14px; }

		.fc-list-table tr:first-child td {
		  border-top-width: 0; }

		/* day headings with the list */
		.fc-list-heading {
		  border-bottom-width: 1px; }

		.fc-list-heading td {
		  font-weight: bold; }

		.fc-ltr .fc-list-heading-main {
		  float: left; }

		.fc-ltr .fc-list-heading-alt {
		  float: right; }

		.fc-rtl .fc-list-heading-main {
		  float: right; }

		.fc-rtl .fc-list-heading-alt {
		  float: left; }

		/* event list items */
		.fc-list-item.fc-has-url {
		  cursor: pointer;
		  /* whole row will be clickable */ }

		.fc-list-item-marker,
		.fc-list-item-time {
		  white-space: nowrap;
		  width: 1px; }

		/* make the dot closer to the event title */
		.fc-ltr .fc-list-item-marker {
		  padding-right: 0; }

		.fc-rtl .fc-list-item-marker {
		  padding-left: 0; }

		.fc-list-item-title a {
		  /* every event title cell has an <a> tag */
		  text-decoration: none;
		  color: inherit; }

		.fc-list-item-title a[href]:hover {
		  /* hover effect only on titles with hrefs */
		  text-decoration: underline; }

		/* message when no events */
		.fc-list-empty-wrap2 {
		  position: absolute;
		  top: 0;
		  left: 0;
		  right: 0;
		  bottom: 0; }

		.fc-list-empty-wrap1 {
		  width: 100%;
		  height: 100%;
		  display: table; }

		.fc-list-empty {
		  display: table-cell;
		  vertical-align: middle;
		  text-align: center; }

		.fc-unthemed .fc-list-empty {
		  /* theme will provide own background */
		  background-color: #eee; }


		.fc th.fc-day-header{
		    padding: 11px 7px;
		    font-size: 16px;
		    font-weight: 400;
		}
		.fc-day.fc-today{
		    background: rgba(52,40,104,.03);
		}
		.fc-day.alert-info{
		    background: rgba(52,40,104,.03);
		}

		.datepicker{
			z-index: 123456;
		}
		body{
		  font-family: 'Nunito', sans-serif;
		  background: #F3F5F9;
		}
		.card{
		  border: 0;
		  background: transparent;
		}
		h2{
		  text-transform: uppercase;
		  font-weight: 700;
		  font-size: 22px;
		  text-align: center;
		  letter-spacing: 1px;
		  font-family: 'Montserrat', sans-serif;
		  color: #002147;
		  margin-bottom: 20px;
		}
		.btn{
		  font-size: 15px !important;
		  text-transform: uppercase;
		  font-weight: 700;
		  letter-spacing: 2.5px;
		  font-family: 'Nunito', sans-serif;
		  box-shadow: none !important;
		  border: 0;
		  padding: 10px 20px !important;
		}
		.btn:focus{
		  box-shadow: none;
		}
		.btn.btn-primary{
		  background: #002147;
		  color: #ffffff;
		}
		.form-group label{
		  font-weight: 600;
		  letter-spacing: 0.010em;
		  font-size: 18px;
		  margin-bottom: 5px;
		}
		.modal-body{
		  background: #F3F5F9;
		  border-radius: 10px;
		}
		.modal-body h4{
		  text-transform: uppercase;
		  font-weight: 700;
		  font-size: 18px;
		  letter-spacing: 1px;
		  font-family: 'Montserrat', sans-serif;
		  color: #002147;
		  margin-bottom: 20px;
		}
		.modal-body .form-control{
		  box-shadow: none;
		  height: 50px;
		}


		/* related product */
		.related-product{
			padding: 80px 0;
		}
		.related-product .container{
		  max-width: 1200px;
		  width: 100%;
		  margin: 0 auto;
		}
		.related-product ul{
		  padding: 0;
		  margin: 0;
		}
		.related-product ul li{  
			margin-bottom: 30px;
		  list-style-type: none;
		}
		.related-product ul li h3{
			font-weight: 700;
			font-size: 24px;
			padding: 20px 0;
		}
		.related-product ul li a{
			font-weight: 600;
			color: #3b484a;
			text-align: center;
		}
		.related-product ul li a img{
		  max-width: 100%;
		  display: block;
		}
		.related-box{
			max-width: 400px;
			margin: 0 auto;
		}
		.download-btn{
		  padding: 15px;
		  display: inline-flex;
		  align-items: center;
		}
		.download-btn .fa{
		  font-size: 40px;
		  margin-right: 10px;
		}

		.choices__inner {
			background-color: white !important;
		}

		.container {
			max-width: 1740px;
		}

		.select2-container--default .select2-selection--single .select2-selection__rendered {
			width: 450px;
		}

		.select2-container--default .select2-selection--single {
			height: 50px;
			padding: 8px;
		}

		.select2-container--default .select2-selection--single .select2-selection__arrow {
			padding: 22px;
		}

		.select2-container--default .select2-selection--single {
			border: 1px solid #ced4da !important;
		}

		.deleteappoiement {
			background-color: #dc3545 !important;
		}

	</style>

	<div class="page-heading headcalender appointment-head">
	    <div class="page-title mb-3">
	        <div class="row page-title-row">
	            <div class="col-md-6 page-title-left">
	                <h3>Add Appointment</h3>
	            </div>
	            <div class="col-md-6 page-title-right">
	                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
					<select class="breadcrumb"  id="doctorDropdown">
						<option value="all" selected>All Doctors</option>
						@foreach($doctorfilterlist as $doctorfilterlist)
						<option value="{{ $doctorfilterlist->doctor_name }}">{{ $doctorfilterlist->doctor_name }}</option>
						@endforeach
					</select>
	                </nav>
	            </div>
	        </div>
	    </div>

	    <!-- // Basic multiple Column Form section start -->
	    <section id="multiple-column-form">
	        <div class="p-5">
				<!-- <h2 class="mb-4">Full Calendar</h2> -->
				<div class="card custom-calendar">
				    <div class="card-body p-0">
				      <div id="calendar"></div>
				    </div>
				</div>
			</div>

			<!-- calendar modal -->
			<div id="modal-view-event" class="modal modal-top fade calendar-modal">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
						<div class="modal-body">
							<h4 class="modal-title"><span class="event-icon"></span><span class="event-title"></span></h4>
							<div class="event-body"></div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>

			<div id="modal-view-event-add" class="modal modal-top fade calendar-modal appontment-modal">
			  	<div class="modal-dialog modal-dialog-centered">
			    	<div class="modal-content">
			      	<form id="add-event">
			      		@csrf
			      		<!-- <input type="hidden" name="appontmentdate" id="appontmentdate" value=""> -->
			        	<div class="modal-body">
			        		<h4>Add Appointment</h4>
					        <div class="form-group">
					            <label>Patient List</label>
					            <select class="js-example-basic-single form-select" id="patientlist" name="patientlist" required>
					                <option value="">Please Select Patient</option>
				              	@foreach($appointList as $patientlist)
				              		@if($patientlist['name'] != '' || $patientlist['name'] != null)
                            <option value="{{ $patientlist->name }}">{{ $patientlist->name }}</option>
                            @endif
                        @endforeach
					            </select>
					            <input type="hidden" name="startDate" id="startDate">
					            <input type="hidden" name="endDate" id="endDate">
					            <input type="hidden" name="patientNumber" id="patientNumber">
					            <input type="hidden" name="patientName" id="patientName">
					            <input type="hidden" name="patientGender" id="patientGender">

					        </div>   
					          <div class="form-group">
					            <label>Doctor List</label>
					            <select class="js-example-basic-single form-select" id="doctorlist" name="doctorlist" required>
					                <option value="">Please Select Doctor</option>
				              	@foreach($doctorappointList as $doctorlist)
				              		@if($doctorlist['doctor_name'] != '' || $doctorlist['doctor_name'] != null)
	                        <option value="{{ $doctorlist->doctor_name }}">{{ $doctorlist->doctor_name }}</option>
	                        @endif
	                    @endforeach
					            </select>
					            <input type="hidden" name="startDDate" id="startDDate">
					            <input type="hidden" name="endDDate" id="endDDate">
					            <input type="hidden" name="doctorNumber" id="doctorNumber">
					            <input type="hidden" name="doctorName" id="doctorName">
					            <input type="hidden" name="doctorGender" id="doctorGender">

					        </div>

			          		<div class="form-group">
			            		<label>Remarks</label>
			            		<textarea class="form-control" name="remarks" id="remarks"></textarea>
			          		</div>    
			      		</div>
				        <div class="modal-footer">
				        	<button type="submit" class="btn btn-primary" id="Addsave">Save</button>
				        	<button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>        
				      	</div>
			      	</form>
			    	</div>
			  	</div>
			</div>

			<div id="modal-view-event-edit" class="modal modal-top fade calendar-modal appontment-modal">
			  	<div class="modal-dialog modal-dialog-centered">
			    	<div class="modal-content">
			      	<form id="edit-event">
			      		@csrf
			      		<input type="hidden" name="appointmentid" id="appointmentid" value="">
			        	<div class="modal-body">
			        		<h4>Update Appointment</h4>
					        <div class="form-group">
					            <label>Patient List</label>
								<input type="hidden" id="patientContact" name="patientContact" value="">
					            <select class="js-example-basic-single form-select" id="updatepatientlist" name="updatepatientlist">
					              	@foreach($appointList as $patientlist)
					              		@if($patientlist['name'] != '' || $patientlist['name'] != null)
                              <option value="{{ $patientlist->name }}" data-contact="{{ $patientlist->contact_1 }}">{{ $patientlist->name }}</option>
                              @endif
                          @endforeach
					            </select>
					            <input type="hidden" name="startDate" id="startDate">
					            <input type="hidden" name="endDate" id="endDate">
					        </div>    
					        <div class="form-group">
					            <label>Doctor List</label>
					            <select class="js-example-basic-single form-select" id="updatedoctorlist" name="updatedoctorlist">
					              	@foreach($doctorappointList as $doctorlist)
					              		@if($doctorlist['doctor_name'] != '' || $doctorlist['doctor_name'] != null)
                              <option value="{{ $doctorlist->doctor_name }}">{{ $doctorlist->doctor_name }}</option>
                              @endif
                          @endforeach
					            </select>
					            <input type="hidden" name="startDDate" id="startDDate">
					            <input type="hidden" name="endDDate" id="endDDate">
					        </div> 
							<div class="form-group">
					            <label>Status</label>
					            <select class="js-example-basic-single form-select" id="status" name="status" required>
					           		<option value="">Select Status</option>
					           		<option value="Done">Done</option>
					           		<option value="Reschedule">Reschedule</option>
					           		<option value="Cancel">Cancel</option>
					            </select>
					        </div>
							<input type="datetime-local"  class="form-control" id="Rdatetime" name="Rdatetime" >
							<p style="color:red" id="alertmessage"></p>                  
			          		<div class="form-group">
			            		<label>Remarks</label>
			            		<textarea class="form-control" name="updateremarks" id="updateremarks"></textarea>
			          		</div>    
			      		</div>
				        <div class="modal-footer">
				        	<button type="submit" class="btn btn-primary" id="Esave">Save</button>
				        	<button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="Eclose">Close</button>        
				        	<button type="button" class="btn btn-primary deleteappoiement">Delete</button>        
				      	</div>
			      	</form>
			    	</div>
			  	</div>
			</div>
	    </section>
	    <!-- // Basic multiple Column Form section end -->
	</div>
@endsection

@section('jsscript')
	
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/air-datepicker/2.2.3/js/datepicker.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/air-datepicker/2.2.3/js/i18n/datepicker.en.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('assets/js/pages/choices.js') }}"></script>
	<script>
		var instantInstanceId = '{{ env('INSTANT_INSTANCE_ID') }}';
		var instantAccessToken = '{{ env('INSTANT_ACCESS_TOKEN') }}';
		console.log('zzzzzz',instantInstanceId)
	</script>

	<script>
		$(document).ready(function () {
			$('#modal-view-event-edit').on('click', function (e) {
				if (e.target === this) {
					// The modal background was clicked
					$('#modal-view-event-edit').modal('hide');
					location.reload(); // Reload the page
				}
			});

			$('#Eclose').on('click', function () {
				// Close button was clicked
				$('#modal-view-event-edit').modal('hide');
				location.reload(); // Reload the page
			});
		});
	</script>

	<script type="text/javascript">

		$(document).ready(function() {
			$("#patientlist").select2({ dropdownParent: "#modal-view-event-add" });
			$("#doctorlist").select2({ dropdownParent: "#modal-view-event-add" });
			// Assuming you have an element that represents your reschedule event
			$(document).on('change', '#status', function() {
				// Extract the new status from the user
				var selectedVal = $('#status').val();

				if (selectedVal === 'Reschedule') {
					$('#Rdatetime').show();

					// Attach a change event handler to the Rdatetime input
					$(document).on('change', '#Rdatetime', function() {
						var rdatetime = $('#Rdatetime').val();
						const formattedStr = rdatetime.replace('T', ' ').trim();
						console.log('11111111', formattedStr);

						// Handle modal update here
						if (formattedStr) {
							var updatePatient = $('#updatepatientlist').val();
							var updateDoctor = $('#updatedoctorlist').val();

							// Populate the modal with the new date and values
							$('#startDate').val(formattedStr);
							$('#patientlist').val(updatePatient).trigger('change');
							$('#doctorlist').val(updateDoctor).trigger('change');

							// Open the modal
							$('#modal-view-event-add').modal('show');
							$('#Esave').click();
							$('#modal-view-event-edit').modal('hide');
							$('#Addsave').click();
							// updatestatus(formattedStr);
							location.reload(); // Use location.reload() to refresh the page
						}
					});
				} else {
					$('#Rdatetime').hide();
				}
			});

		});

		let choices = document.querySelectorAll('.choices');
		let initChoice;
		for(let i=0; i<choices.length;i++) {
		  if (choices[i].classList.contains("multiple-remove")) {
		    initChoice = new Choices(choices[i],
		      {
		        delimiter: ',',
		        editItems: true,
		        maxItemCount: -1,
		        removeItemButton: true,
		      });
		  }else{
		    initChoice = new Choices(choices[i]);
		  }
		}

		jQuery(document).ready(function(){
		  	jQuery('.datetimepicker').datepicker({
		      	timepicker: true,
		      	language: 'en',
		      	range: true,
		      	multipleDates: true,
				multipleDatesSeparator: " - ",
		    });
		  	// jQuery("#add-event").submit(function(){
		    //   	// alert("Submitted");
		    //   	var values = {};
		    //   	$.each($('#add-event').serializeArray(), function(i, field) {
		    //      	values[field.name] = field.value;
		    //   	});
			//      console.log(
			//         values
			//     );
		  	// });
		});

		(function () {    
		    'use strict';
		    // ------------------------------------------------------- //
		    // Calendar
		    // ------------------------------------------------------ //
			jQuery(function() {
				var booking = @json($events);
				// console.log(booking);
				// page is ready
				var defaultView = 'agendaWeek'; // Default view
				
                var hiddenValue = '{{ request()->query('Dashboard') }}';
                if (hiddenValue == 1) {
                    // Change the default view if the hidden value is 1
                    defaultView = 'agendaDay'; // Change this to the desired view when the hidden value is 1
                }else if (hiddenValue == 2){
                    defaultView = 'month'; // Change this to the desired view when the hidden value is 1
                }
				jQuery('#calendar').fullCalendar({
  					timeZone: 'UTC', // the default (unnecessary to specify)
					themeSystem: 'bootstrap4',
					// emphasizes business hours
					businessHours: false,
					defaultView: defaultView,
					slotDuration: '00:15:00',
					snapDuration: '00:15:00',
					slotLabelInterval: 15,
					minTime: "10:00:00",
        			maxTime: "22:00:00",
					// event dragging & resizing
					disableDragging: false, 
					disableResizing: false, 
					editable: false,
					// header
					header: {
						left: 'title',
						center: 'month,agendaWeek,agendaDay',
						right: 'today prev,next'
					},
					views: {
						month: {
							columnFormat: 'ddd' // set format for month here
						},
						week: {
							columnFormat: 'ddd, D/M' // set format for week here
						},
						day: {
							columnFormat: 'dddd' // set format for day here
						}
					},
					eventClick: function(event, jsEvent, view) {
					    // console.log(event.title);
					    $('body #appointmentid').val(event.id);

					    // Split the event title to get the doctor and patient names
					    var names = event.title.split('|');
					    var doctorName = names[0];
					    var patientName = names[1];
					    var status = names[3];

						if (status == 'Done'){
							$('body #alertmessage').text("This Treatment Has Been Done!");
							$('body #updatepatientlist').addClass('disabled');
							$('body #updatedoctorlist').addClass('disabled');
							$('body #status').addClass('disabled');
						}else if(status == 'Cancel'){
							$('body #alertmessage').text("This Treatment Has Been Cancelled!");
							$('body #updatepatientlist').addClass('disabled');
							$('body #updatedoctorlist').addClass('disabled');
							$('body #status').addClass('disabled');
						}

					    // Set the patient and doctor names for the select2 inputs
					    $('body #updatepatientlist').val(patientName).trigger('change');
					    $('body #updatedoctorlist').val(doctorName).trigger('change');
					    $('body #status').val(status).trigger('change');

					    $('body #updateremarks').val(event.description);
					    jQuery('#modal-view-event-edit').modal('show');
					},
					events: booking,

					// [
					// 	{
					// 		title: 'Barber',
					// 		description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras eu pellentesque nibh. In nisl nulla, convallis ac nulla eget, pellentesque pellentesque magna.',
					// 		start: '2020-05-05',
					// 		end: '2020-05-05',
					// 		className: 'fc-bg-default',
					// 		icon : "circle"
					// 	},
					// ],
					eventRender: function(event, element) {
						var selectedDoctor = $('#doctorDropdown').val();
					    var names = event.title.split('|'); // Assuming the title is in the format "Doctor Name|Patient Name"
					    var doctorName = names[0];
					    var patientName = names[1];
					    var color = names[2];
						var status = names[3]; // Assuming the status is in the fourth position of the event title


					    var html = "<div><strong>" + doctorName + "</strong></div>";
					    html += "<div>" + patientName + "</div>";

					    // Check if the selected doctor matches the appointment's doctor
    					if (selectedDoctor === 'all' || selectedDoctor === doctorName) {
							element.find(".fc-title").html(html);

							if (event.icon) {
								element.find(".fc-title").prepend("<i class='fa fa-" + event.icon + "'></i>");
							}
								if (color) {
										element.css('background-color', color);
								}
								
								if (status === 'Done') {
									// If the status is 'Done', add a 'check' icon and apply a class for positioning
									element.find(".fc-title").prepend("<i class='fa fa-check done-icon'></i>");
								} else if (status === 'Cancel') {
									// If the status is 'Cancel', add a 'times' icon and apply a class for positioning
									element.find(".fc-title").prepend("<i class='fa fa-times cancel-icon'></i>");
								}
						}else{
							element.hide(); // Hide appointments for other doctors
						}
					},
					dayClick: function(cDate) {
						var startDate = cDate.format();
						var endDate = cDate.add(15, 'minutes').format();
						$('#startDate').val(startDate);
						$('#endDate').val(endDate);
						// var showtime = $(this).data('time');

						// console.log(showdate);
						// console.log(showtime);

						jQuery('#modal-view-event-add').modal('show');
					},
					selectable: true,
			        select: function(startDate, endDate, jsEvent, view, resource) {
			          	// alert('selected ' + startDate.format() + ' to ' + endDate.format() + ' on resource ');
			          	$('#startDate').val(startDate.format());
			          	$('#endDate').val(endDate.format());
			          	// $('#startDDate').val(startDate.format());
			          	// $('#endDDate').val(endDate.format());
						jQuery('#modal-view-event-add').modal('show');
			        }
				})
			});
		  
		})(jQuery);

		$('#doctorDropdown').on('change', function () {
			$('#calendar').fullCalendar('rerenderEvents'); // Re-render the events based on the new selection
		});

	</script>
 
    <script>
		$(document).ready(function() {

		    $("#add-event").submit(function(e){
		    	var $this = $(this);
		    	var formData = $this.serializeArray();
		    	$("#overlay").fadeIn(300);
		    	$.ajax({
		    		url: "{{ route('addAppontmentinfo') }}",
		    		type: "POST",
		    		data: formData,
		    		dataType: "json", 
		    		success: function(response) {
		    			$("#overlay").fadeOut(300);
              if(response.result)
              {
                  Swal.fire({
                    icon: "success",
                    title: "Success",
                    timer: 1000,
                    button:"OK",
                    showConfirmButton:false
                  }).then(function() {
                  	sendsms();
					doctormsg();
                  	$("#modal-view-event-add").modal('hide');
                  	window.location.href = "{{ url('/addappontment') }}";
                  });
              }
              else
              {
                  Swal.fire({
                      icon: "error",
                      title: "Error"
                  });
              }
            }
		    	});
		    	
		    	e.preventDefault();
		    });

		    $("#edit-event").submit(function(e){		    	
		    	var $this = $(this);
		    	var formData = $this.serializeArray();
		    	$("#overlay").fadeIn(300);
		    	$.ajax({
		    		url: "{{ route('updateAppontmentinfo') }}",
		    		type: "POST",
		    		data: formData,
		    		dataType: "json", 
		    		success: function(response) {
		    			$("#overlay").fadeOut(300);
              if(response.result)
              {
                  Swal.fire({
                      icon: "success",
                      title: "Success",
                      timer: 2000,
                      button:"OK",
                      showConfirmButton:false
                  }).then(function() {
					RUdate = response.data.from_time;
					// updatestatus(RUdate);
					if(response.data.status != 'Reschedule'){
						location.reload();
					}
					console.log("3333333",response.data.status)
                  });
              }
              else
              {
                  Swal.fire({
                      icon: "error",
                      title: "Error"
                  });
              }
            }
		    	});
		    	
		    	e.preventDefault();
		    });

		    // To send sms for patient after submit apponyment

		    // $('#sendsms').click(function(e){
		    // 	e.preventDefault();
				// 	var instanceid = '64059ae17d0845643a0aa13b';
				// 	var phone = 9762660625;//$("#patientNumber").val();
				// 	var message = 'Hello';//$("#remarks").val();

			  //   $.ajax({
	    	// 	url: 'https://wts.vision360solutions.co.in/api/sendText',
	    	// 	type: "GET",
	    	// 	data: {"message": message, "phone": phone, "token": instanceid},
	    	// 	dataType: "json", 
	    	// 	success: function(response) {
	    	// 		console.log(response);	 
        //     }
	    	// 	});
				// });

		    // To send sms for patient after submit apponyment

				sendsms = function() {
					var appointDate = $("#startDate").val();
					var startAppointDate = moment(appointDate).format("DD-MM-YYYY hh:mm A").split(' ');
					var dateSplit = startAppointDate[0].split('-');
					var currentDate = dateSplit[0] + '/' + dateSplit[1] + '/' + dateSplit[2];
					var currentTime = startAppointDate[1];
					var currentInday = startAppointDate[2];
					var phone = $("#patientNumber").val();
					var patientName = $("#patientName").val();
					var docName = $("#doctorName").val();

                    var psex = $("#patientGender").val();

					if(psex == '1'){
						var pgender = 'Mr. '
					}else{
						var pgender = 'Miss. '
					}
					var message = pgender + patientName + " your appointment with " + docName + " on " + currentDate + " at " + currentTime + " " + currentInday + " has been confirmed. \n\nTo cancel or reschedule this appoitment, reply to this message or contact us at 9535751921. For general enquiries, text this number or visit our official website: https://punedentists.com/. for further information. \n\nThank you for trusting \nDr. Ishita's Dental & Implant Clinic.";

					$.ajax({
						url: 'https://allexpert.store/api/send',
						type: "POST", // Use POST to send data
						data: {
							number: '91' + phone, // Insert '91' before the phone number
							type: "text",
							message: message,
							instance_id: instantInstanceId,
							access_token: instantAccessToken
						},
						dataType: "json",
						success: function (response) {
							console.log(";;;;;;;;",response);
						}
					});

				}

				doctormsg = function(){
					var appointDate = $("#startDate").val();
					var startAppointDate = moment(appointDate).format("DD-MM-YYYY hh:mm A").split(' ');
					var dateSplit = startAppointDate[0].split('-');
					var currentDate = dateSplit[0] + '/' + dateSplit[1] + '/' + dateSplit[2];
					var currentTime = startAppointDate[1];
					var currentInday = startAppointDate[2];
					var docNumber = $("#doctorNumber").val();
					var docName = $("#doctorName").val();
					var patientName = $("#patientName").val();
					
					var dsex = $("#doctorGender").val();

					if(dsex == '1'){
						var dgender = 'Mr. '
					}else{
						var dgender = 'Miss. '
					}
					
					var message = dgender + docName + " your appointment with Pt." + patientName + " on " + currentDate + " at " + currentTime + " " + currentInday + " has been confirmed. \n\nTo cancel or reschedule this appoitment, reply to this message or contact us at 9535751921. For general enquiries, text this number or visit our official website: https://punedentists.com/. for further information. \n\nThank you for trusting \nDr. Ishita's Dental & Implant Clinic.";


					$.ajax({
						url: 'https://allexpert.store/api/send',
						type: "POST", // Use POST to send data
						data: {
							number: '91' + docNumber, // Insert '91' before the phone number
							type: "text",
							message: message,
							instance_id: instantInstanceId,
							access_token: instantAccessToken
						},
						dataType: "json",
						success: function (response) {
							console.log(";;;;;;;;",response);
						}
					});

				}

				
				$('#updatepatientlist').change(function() {
					var selectedOption = $('#updatepatientlist option:selected');
					var contact = selectedOption.data('contact');
					$('#patientContact').val(contact);
				});

				updatestatus = function(formatteddate) {
					selectedStatus = $('#status').val(); 
					var phone = $("#patientContact").val();
					var patientName = $("#updatepatientlist").val();

					if(selectedStatus == 'Done'){
						var message = "Dear " + patientName + "\nYou have an appointment Done with us related to  Dental treatment \n Dr. Ishita's Dental & Implant Clinic."  + formatteddate;
					}
					if(selectedStatus == 'Reschedule'){
						var message = "Dear " + patientName + "\nYou have an appointment Reschedule with us related to  Dental treatment \n Dr. Ishita's Dental & Implant Clinic." + formatteddate;
					}
					if(selectedStatus == 'Cancel'){
						var message = "Dear " + patientName + "\nYou have an appointment Cancel with us related to  Dental treatment \n Dr. Ishita's Dental & Implant Clinic."  + formatteddate;
					}

					$.ajax({
						url: 'https://allexpert.store/api/send',
						type: "POST", // Use POST to send data
						data: {
							number: '91' + phone, // Insert '91' before the phone number
							type: "text",
							message: message,
							instance_id: instantInstanceId,
							access_token: instantAccessToken
						},
						dataType: "json",
						success: function (response) {
							console.log(";;;;;;;;",response);
						}
					});

				}

		    // On change patient select option to get patient number

				$("select#patientlist").change(function (e) {  
		    	e.preventDefault();
	        var selectedPatient = $(this).children("option:selected").val();

	        $.ajax({
					url: "{{ url('/getPatientnumber') }}",
					type: "POST",
					data: {"patientId": selectedPatient, "_token": $("[name='_token']").val()},
		        success: function(response) {
		        	if(response.response) {			    
					    	$('#patientNumber').val(response.data[0].contact_1);
					    	$('#patientName').val(response.data[0].name);
					    						    	$('#patientGender').val(response.data[0].sex);

	    				}
		        }
					});
	    	});

		    // On change doctor select option to get doctor number

				$("select#doctorlist").change(function (e) {  
		    	e.preventDefault();
	        var selectedDoctor = $(this).children("option:selected").val();

	        $.ajax({
					url: "{{ url('/getDoctornumber') }}",
					type: "POST",
					data: {"doctorId": selectedDoctor, "_token": $("[name='_token']").val()},
		        success: function(response) {
		        	if(response.response) {			    
					    	$('#doctorNumber').val(response.data[0].contact);
					    	$('#doctorName').val(response.data[0].doctor_name);
					    						    	$('#doctorGender').val(response.data[0].sex);

	    				}
		        }
					});
	    	});

	    	$(".deleteappoiement").on("click", function(e){
					var appid = $("#appointmentid").val();					
					$.ajax({
						url: "{{ url('/deleteAppoiement') }}",
						type: "DELETE",
						data: {"appointmentId": appid, "_token": $("[name='_token']").val()},
			        success: function(response) {
			        	if(response.result) {
			        		Swal.fire({
                      icon: "success",
                      title: "Appointment Delete",
                      timer: 2000,
                      showConfirmButton:false
                  }).then(function() {
                      location.reload();
                  });
              }
              else
              {
                  Swal.fire({
                      icon: "error",
                      title: "Error"
                  });
              }
				    }
					});
					e.preventDefault();
				}); 

				$('#updatepatientlist').trigger('refresh');
		});    
    </script>
@endsection