import { ApiProperty } from "@nestjs/swagger";
import { Column, Entity, PrimaryGeneratedColumn } from "typeorm";

@Entity()
export class User {
    @PrimaryGeneratedColumn()
    id: number;
    
    @ApiProperty()
    @Column()
    firtsName: string;

    @ApiProperty()
    @Column()
    lastName: String;
}