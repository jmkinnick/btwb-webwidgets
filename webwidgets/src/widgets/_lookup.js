import WodsWidget from './Wods';
import ActivitiesWidget from './Activities';
import LeadersWidget from './Leader';
import InvalidWidgetTypeWidget from './InvalidWidgetTypeWidget';

export default function(widget_type) {
  switch (widget_type) {
  case 'wods':
    return WodsWidget;
  case 'activities':
    return ActivitiesWidget;
  case 'leaders':
    return LeadersWidget;
  default:
    return InvalidWidgetTypeWidget;
  }
};