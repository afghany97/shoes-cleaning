function cancel() {
    if(confirm('are you sure ?')) {
        return window.location.replace('/home');
    } else {
        return false;
    }
}
