
const bookingButton = document.querySelector("#booking");
const successToast = new bootstrap.Toast(document.getElementById('success-notification'));
const form = document.querySelector("#getBooking")
const startDateInput = document.querySelector("#startDate")
const amountVouchers = document.querySelector("#amountVouchers").innerHTML;
let amount = amountVouchers.replace(/[А-я]|[^\w\s]/g, "");
if(amount<=0)
{
bookingButton.classList.add('disabled');
}
booking.addEventListener('click', (event) => {
  event.preventDefault();
    
  const checkDate = () => {
      const inputDate = new Date(startDateInput.value);
      const currentDate = new Date();
      if (isNaN(inputDate) || inputDate < currentDate) {
        return false;
      } else
        return true;
    }

    !checkDate() ? startDateInput.style.borderColor = "red" : startDateInput.style.borderColor = "LightGray";
  if (checkDate() && amount>0) {
    successToast.show();
    setTimeout(() => form.submit(), 4000)
  }
  

  setTimeout(() => successToast.hide(), 3000)


})