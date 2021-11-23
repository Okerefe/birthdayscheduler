<template>
  <div>
    <div id="clock">
      <p><i>Birthday Scheduler '1.0.0'</i></p>
      <p class="desc">{{ date }}</p>
      <br/>
      <p class="time">{{ time }}</p>
      <p class="text">Current Date and Time.</p>
    </div>
  </div>
</template>

<script>
  export default {
    name: 'current-date-time',


    data() {
      return {
        week: ['SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT'],
        time: '',
        date: '',
      }
    },

    methods: {
      updateTime() {
        let cd = new Date();
        this.time = this.zeroPadding(cd.getHours(), 2) + ':' + this.zeroPadding(cd.getMinutes(), 2) + ':' + this.zeroPadding(cd.getSeconds(), 2);
        this.date = this.zeroPadding(cd.getFullYear(), 4) + '-' + this.zeroPadding(cd.getMonth()+1, 2) + '-' + this.zeroPadding(cd.getDate(), 2) + ' ' + this.week[cd.getDay()];
      },
      zeroPadding(num, digit) {
        let zero = '';
        for(let i = 0; i < digit; i++) {
          zero += '0';
        }
        return (zero + num).slice(-digit);
      },
    },
    created() {
      let timerID = setInterval(this.updateTime, 1000);
      this.updateTime();
    },
  }
</script>

<style>
  #clock {
    border-radius: 5px;
    padding-top: 20px;
    align-content: center;
    background: #0f3854;
    background: radial-gradient(ellipse at center,  #0a2e38  0%, #000000 70%);
    background-size: 100%;
  }
  p {
    margin: 0;
    padding: 0;
  }
  #clock {
    font-family: 'Share Tech Mono', monospace;
    color: #ffffff;
    text-align: center;
    color: #daf6ff;
    text-shadow: 0 0 20px rgba(10, 175, 230, 1), 0 0 20px rgba(10, 175, 230, 0);
  }
  .time {
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
    font-size: 12px;
    padding: 20px 0 0;
  }

</style>
