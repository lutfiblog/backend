import express from 'express';
import mongoose from 'mongoose';

import monitorMessage from '../models/monitoringMessage.js';

const router = express.Router();

export const getPosts = async (req, res) => { 
    try {
        const monitorMessages = await monitorMessage.find();
                
        res.status(200).json(monitorMessages);
    } catch (error) {
        res.status(404).json({ message: error.message });
    }
}

export const getPost = async (req, res) => { 
    const { id } = req.params;

    try {
        const monitor = await monitorMessage.findById(id);
        
        res.status(200).json(monitor);
    } catch (error) {
        res.status(404).json({ message: error.message });
    }
}

export const createPost = async (req, res) => {
    const { sensor1, sensor2, sensor3, sensor4 } = req.body;

    const newmonitorMessage = new monitorMessage({ sensor1, sensor2, sensor3, sensor4  })

    try {
        await newmonitorMessage.save();

        res.status(201).json(newmonitorMessage );
    } catch (error) {
        res.status(409).json({ message: error.message });
    }
}

export const updatePost = async (req, res) => {
    const { id } = req.params;
    const { sensor1, sensor2, sensor3, sensor4  } = req.body;
    
    if (!mongoose.Types.ObjectId.isValid(id)) return res.status(404).send(`No monitor with id: ${id}`);

    const updatedmonitor = { sensor1, sensor2, sensor3, sensor4, _id: id };

    await monitorMessage.findByIdAndUpdate(id, updatedmonitor, { new: true });

    res.json(updatedmonitor);
}

export const deletePost = async (req, res) => {
    const { id } = req.params;

    if (!mongoose.Types.ObjectId.isValid(id)) return res.status(404).send(`No monitor with id: ${id}`);

    await monitorMessage.findByIdAndRemove(id);

    res.json({ message: "monitor deleted successfully." });
}

export default router;