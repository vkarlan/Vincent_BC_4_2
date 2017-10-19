import { Injectable } from '@angular/core';

@Injectable()
export class DataService {

  id : number;
  name : string = "";

  constructor() { }
  courseList: object[] = [
    {'name' : 'asdf'},
  ]
  AddCourse(){
    this.courseList.push({
      "name" : this.name
    });
  }
}
