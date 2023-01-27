import Pusher from 'pusher-js';

const options = {
  cluster: 'eu',
  encrypted: true,
};

export const pusher = new Pusher('7d715600526512bac5e3', {
    cluster: 'eu',
    auth: {
      params: {
        'auth_key': '7d715600526512bac5e3',
      }
    }
  });

pusher.connection.bind('connected', () => {
    console.log('connected to Pusher');
  });

/*const channel = pusher.subscribe('my-channel');

console.log(channel) ;
channel.bind('my-event', (data) => {
console.log("channel name is: ", channel.name);
console.log(JSON.stringify(data));
});*/
