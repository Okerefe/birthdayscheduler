/**
 * @jest-environment jsdom
 */
import { mount } from '@vue/test-utils'
import CurrentDateTime from '../../../js/src/Components/CurrentDateTime.vue'

describe('CurrentDateTime Component', () => {
  test('renders the correct date', () => {
    const wrapper = mount(CurrentDateTime)

    const dateWrapper = wrapper.get('.desc');
    let cd = new Date();
    let week = ['SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT'];
    expect(dateWrapper.text()).toContain(cd.getFullYear());
    expect(dateWrapper.text()).toContain(cd.getMonth()+1);
    expect(dateWrapper.text()).toContain(week[cd.getDay()]);
  })

  test('renders the correct time', () => {
    const wrapper = mount(CurrentDateTime)

    const timeWrapper = wrapper.get('.time')
    let cd = new Date();

    expect(timeWrapper.text()).toContain(cd.getHours());
    expect(timeWrapper.text()).toContain(cd.getMinutes());
  })

});



