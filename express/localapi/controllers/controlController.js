import express from 'express';
import mongoose from 'mongoose';

import controlMessage from '../models/controlMessage.js';

const router = express.Router();

export const getPosts = async (req, res) => { 
    try {
        const controlMessages = await controlMessage.find();
                
        res.status(200).json(controlMessages);
    } catch (error) {
        res.status(404).json({ message: error.message });
    }
}

export const getPost = async (req, res) => { 
    const { id } = req.params;

    try {
        const control = await controlMessage.findById(id);
        
        res.status(200).json(control);
    } catch (error) {
        res.status(404).json({ message: error.message });
    }
}

export const createPost = async (req, res) => {
    const { id1, id2, id3, id4 } = req.body;

    const newcontrolMessage = new controlMessage({ id1, id2, id3, id4  })

    try {
        await newcontrolMessage.save();

        res.status(201).json(newcontrolMessage );
    } catch (error) {
        res.status(409).json({ message: error.message });
    }
}

export const updatePost = async (req, res) => {
    const { id } = req.params;
    const { id1, id2, id3, id4 } = req.body;
    
    if (!mongoose.Types.ObjectId.isValid(id)) return res.status(404).send(`No control with id: ${id}`);

    const updatedcontrol = { id1, id2, id3, id4, _id: id };

    await controlMessage.findByIdAndUpdate(id, updatedcontrol, { new: true });

    res.json(updatedcontrol);
}

export const deletePost = async (req, res) => {
    const { id } = req.params;

    if (!mongoose.Types.ObjectId.isValid(id)) return res.status(404).send(`No control with id: ${id}`);

    await controlMessage.findByIdAndRemove(id);

    res.json({ message: "control deleted successfully." });
}

export default router;