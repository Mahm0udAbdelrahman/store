// Import the functions you need from the SDKs you need
import { initializeApp } from "firebase/app";
import { getAnalytics } from "firebase/analytics";
import { getMessaging, getToken , onMessage  } from "firebase/messaging";


// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
// For Firebase JS SDK v7.20.0 and later, measurementId is optional
const firebaseConfig = {
  apiKey: "AIzaSyALw7qWTxolOpozDq5I4htmlzTuoEkVpF8",
  authDomain: "push-notification-a5ae0.firebaseapp.com",
  databaseURL: "https://push-notification-a5ae0-default-rtdb.firebaseio.com",
  projectId: "push-notification-a5ae0",
  storageBucket: "push-notification-a5ae0.firebasestorage.app",
  messagingSenderId: "840477060835",
  appId: "1:840477060835:web:4f1f3c7b45520b81e45fd6",
  measurementId: "G-X0FLKYTFBT"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
const analytics = getAnalytics(app);

// Get registration token. Initially this makes a network call, once retrieved
// subsequent calls to getToken will return from cache.
const messaging = getMessaging();
getToken(messaging, { vapidKey: 'BD2A9X0dG9PAQYuuC6Lah8XBEB5R1CTjlowT8UErDxQVLx7aMRLwkwNHyWFy5f4PArX8PJV_OCct13DEKjfE07U' }).then((currentToken) => {
  if (currentToken) {
    console.log('currentToken: ', currentToken);
    $.post('/api/device-tokens', {
      token: currentToken,
        device: 'chrome',
        __token: $('meta[name="csrf-token"]').attr('content')
    });

    // Send the token to your server and update the UI if necessary
    // ...
  } else {
    // Show permission request UI
    console.log('No registration token available. Request permission to generate one.');
    // ...
  }
}).catch((err) => {
  console.log('An error occurred while retrieving token. ', err);
  // ...
})
onMessage(messaging, (payload) => {
    console.log('Message received. ', payload);
    // ...
  });
