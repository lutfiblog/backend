import mongoose from 'mongoose';

const monitorSchema = mongoose.Schema({
    sensor1: String,
    sensor2: String,
    sensor3: String,
    sensor4: String,
    createdAt: {
        type: Date,
        default: new Date(),
    },
})

var monitorMessage = mongoose.model('monitorMessage', monitorSchema);

export default monitorMessage;