export function handleAbort(error) {
     if (error.name === 'AbortError') return;
}