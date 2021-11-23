/**
 * @jest-environment jsdom
 */
import { mount } from '@vue/test-utils'
import Birthday from '../../../js/src/Components/Birthday.vue'

describe('Birthday Component', () => {
  test('returns and updates data and computed values correctly', () => {

    const wrapper = mount(Birthday, {
      propsData: {
        birthday: {"id":"3","first_name":"Deeper","last_name":"Oke","dob":"1999-11-14","mail":"oke@ff.ff","created":"1636628791"},
      }
    })

    // console.log('DB FULL:' + wrapper.vm.dob);
    expect(wrapper.vm.dob.getFullYear()).toBe(1999);
    wrapper.vm.currentDate = new Date('2021-11-20');

    expect(wrapper.vm.currentDate.getFullYear()).toBe(2021);
    expect(wrapper.vm.month).toBe("Nov");
    expect(wrapper.vm.birthdayIsPast()).toBe(true);
    expect(wrapper.vm.age).toBe(23);

    wrapper.vm.currentDate = new Date('2021-11-11');
    wrapper.vm.currentDate.setHours(0, 0, 0, 0);
    expect(wrapper.vm.daysToBday).toBe(3);
  })


  test.each([
    [
      "Oke's Birthday Details",
      {"id":"3","first_name":"Deeper","last_name":"Oke","dob":"1999-01-20","mail":"deep@oke.com","created":"1636628791"},
      '2025-01-12',
      "Deeper's 26th Birthday",
      "Mon, 20th Jan",
      "8 Days to Go",
    ],
    [
      "Jane's Birthday Details",
      {"id":"3","first_name":"Jane","last_name":"Doe","dob":"1999-03-21","mail":"jane@doe.com","created":"1636628791"},
      '2021-03-21',
      "Jane's 22nd Birthday",
      "Sun, 21st Mar",
      "BIRTHDAY IS TODAY",
    ],
  ])('Displays Data and Computed Values Correctly in UI for %s', (name,birthdayObj, currentDate, birthDesc, birthdayDate, daysToGO) => {

    const wrapper = mount(Birthday, {
      propsData: {
        birthday: birthdayObj,
      },
      data () {
        return {
          currentDate: new Date(currentDate),
        }
      }
    })


    const birthdayDesc = wrapper.get('.desc');
    expect(birthdayDesc.text()).toContain(birthDesc);

    const birthDate = wrapper.get('.date');
    expect(birthDate.text()).toContain(birthdayDate);

    const days = wrapper.get('.text');
    expect(days.text()).toContain(daysToGO);

  });

});


