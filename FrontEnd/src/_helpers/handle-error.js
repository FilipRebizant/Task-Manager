export function handleError(error, status) {
     if (status === 500) {
          error = 'An error occurred, please try again in few minutes'
     }

     if (error.name === 'AbortError') return;

     throw(error);
}
