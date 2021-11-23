<template>
  <div>
    <div class="date-clock" :class="{ decorate: !daysToBday }">
      <p class="desc">{{ birthday.first_name }}'s {{ nthAge }} Birthday</p>
      <br/>
      <p class="date">{{ day }}, {{ nthDay }} {{ month }}</p>

      <p class="text" v-if="daysToBday === 0">BIRTHDAY IS TODAY &#129395;&#129395;&#129395;</p>
      <p class="text" v-else="">{{ daysToBday }} Days to Go</p>
    </div>
  </div>
</template>

<script>

  export default {
    name: 'birthday',

    props:  ['birthday'],

    data() {
      return {
        currentDate: new Date(),
        days :  ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
        months: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
      }
    },

    methods: {
      nth(d) {
          if (d > 3 && d < 21) return (d + 'th');
          switch (d % 10) {
            case 1:  return (d + "st");
            case 2:  return (d + "nd");
            case 3:  return (d + "rd");
            default: return (d + "th");
        }
      },
      birthdayIsPast() {
        // We can afford to set the time to 00:00:00 or anything
        // since we only use day, month and year in our app
        return this.dobPresentYear.setHours(0, 0, 0, 1) <= this.currentDate.setHours(0, 0, 0, 0);

      },
    },
    computed : {
      nthDay() {
        return this.nth(this.dob.getDate());
      },
      day() {
        return this.days[this.dobPresentYear.getDay()];
      },
      dobNextYear() {
        return new Date((this.currentDate.getFullYear() + 1), this.dob.getMonth(), this.dob.getDate());
      },
      daysToBday() {
        if(this.birthdayIsPast()) {
          let diffTime = Math.abs(this.dobNextYear - this.currentDate);
          return Math.floor(diffTime / (1000 * 60 * 60 * 24));
        } else {
          let diffTime = Math.abs(this.currentDate - this.dobPresentYear);
          return Math.floor(diffTime / (1000 * 60 * 60 * 24));
        }
      },
      age() {
        if(this.birthdayIsPast()) {
          return  (this.dobNextYear.getFullYear() - this.dob.getFullYear());
        } else {
          return  (this.currentDate.getFullYear() - this.dob.getFullYear());
        }
      },
      month() {
        return this.months[this.dob.getMonth()];
      },
      nthAge() {
        return this.nth(this.age);
      },
      dobPresentYear(){
        return new Date(this.currentDate.getFullYear(), this.dob.getMonth(), this.dob.getDate());
      }
    },

    created() {
      this.dob = new Date(this.birthday.dob);
    },
  }
</script>

<style>
  .date-clock {
    width: 60%;
    margin: 0 auto;
    border-radius: 5px;
    padding-top: 20px;
    padding-bottom: 10px;
    align-content: center;
    background: #0f3854;
    background: radial-gradient(ellipse at center,  #0a2e38  0%, #000000 70%);
    background-size: 100%;
    margin-bottom: 5px;
  }
  p {
    margin: 0;
    padding: 0;
  }
  .date-clock {
    font-family: 'Share Tech Mono', monospace;
    color: #ffffff;
    text-align: center;
    color: #daf6ff;
    text-shadow: 0 0 20px rgba(10, 175, 230, 1), 0 0 20px rgba(10, 175, 230, 0);
  }
  .date {
    letter-spacing: 0.05em;
    font-size: 80px;
    padding: 5px 0;
  }
  .desc {
    letter-spacing: 0.1em;
    font-size: 24px;
  }
  .text {
    letter-spacing: 0.1em;
    font-size: 18px;
    padding: 20px 0 0;
  }
  .decorate {
    animation: myanimation 10s infinite;
  }

  @keyframes myanimation {
    0% {background: red;}
    25%{background:yellow;}
    50%{background:green;}
    75%{background:brown;}
    100% {background: red;}
  }

</style>
