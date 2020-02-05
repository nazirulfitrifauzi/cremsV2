<template>
  <li class="nav-item dropdown">
      <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <div class="media align-items-center">
            <i class="fas fa-bell fa-2x"></i>
            <span class="notifications" v-if="notifications.length > 0" v-text="notifications.length"></span>
          </div>
      </a>
      <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
        <a class="dropdown-item" href="#" v-if="!notifications.length">No New Notification.</a>
        <a class="dropdown-item" href="" v-for="(notification, index) in notifications.slice(0,5)" :key="index" @click="readNotification(notification)">
          <div>
            <span>{{notification.body}}</span>
            <div class="clearfix" direction="left">
              <div>
                <span>
                  <span style="font-size: 10px;color: gray;font-weight: lighter;">{{moment(notification.created_at).fromNow()}}</span>
                </span>
              </div>
            </div>
          </div>
        </a>
        <div class="dropdown-divider" v-if="notifications.length > 5"></div>
        <a class="dropdown-item" href="#" v-if="notifications.length > 5">See all notifications.</a>
      </div>
  </li>
</template>

<script>
var moment = require('moment');

export default {
    data() {
      return {
        moment: moment,
        notifications: []
      };
    },

    methods: {
      playSound (sound) {
        if(sound) {
          var audio = new Audio(sound);
          audio.play();
        }
      },

      fetchNotification() {
        axios.get('/notifications').then(response => (this.notifications = response.data));

        window.Echo.channel('new-user-registered').listen('newUserRegistered', e => {
          this.notifications.unshift(e.notification);
          this.playSound('http://soundbible.com/mp3/Elevator Ding-SoundBible.com-685385892.mp3');
        });
      },

      readNotification(notification) {
        axios.post('/notifications', { id:notification.id }).then(response => (this.notifications.splice(this.notifications.indexOf(notification.id),1)));
      },
    },

    created() {
      this.fetchNotification();
    }
};
</script>
