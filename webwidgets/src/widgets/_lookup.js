
import WodsWidget from './Wods';
import InvalidWidgetTypeWidget from './InvalidWidgetTypeWidget';

export default function(widget_type) {
  switch (widget_type) {
  case 'wods':
    return WodsWidget;
  default:
    return InvalidWidgetTypeWidget;
  }
};

