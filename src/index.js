import React from 'react';
import ReactDOM from 'react-dom';
import { LocalizationProvider } from '@mui/lab/LocalizationProvider';
import AdapterDayjs from '@mui/lab/AdapterDayjs';
import MobileDateTimePicker from '@mui/lab/MobileDateTimePicker';
import { TextField } from '@mui/material';
import dayjs from 'dayjs';

const DateTimePickerComponent = () => {
  return (
    <LocalizationProvider dateAdapter={AdapterDayjs}>
      <MobileDateTimePicker
        label="Mobile variant"
        defaultValue={dayjs()}
        renderInput={(params) => <TextField {...params} />}
      />
    </LocalizationProvider>
  );
};

const rootElement = document.getElementById('react-datetime-picker');
if (rootElement) {
  ReactDOM.render(<DateTimePickerComponent />, rootElement);
}
